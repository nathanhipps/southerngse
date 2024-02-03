<?php

namespace App\Models;

use App\Concerns\HasItemAmounts;
use App\Contracts\Itemable;
use App\Notifications\Admin\OrderReceivedNotification;
use App\Notifications\Customer\OrderPlacedNotification;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Notification;

class Order extends Model implements Itemable
{
    use HasFactory;
    use SoftDeletes;
    use HasItemAmounts;

    protected $casts = [
        'closed_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => (int) round($value * 100),
        );
    }

    public function getSubtotalInCents(): int
    {
        return $this->subtotal * 100;
    }

    protected function shipping(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => (int) round($value * 100),
        );
    }

    public function getShippingInCents(): int
    {
        return $this->shipping * 100;
    }

    protected function tax(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => (int) round($value * 100),
        );
    }

    public function getTaxInCents(): int
    {
        return $this->tax * 100;
    }

    protected function total(): Attribute
    {
        return Attribute::make(
            get: fn (int $value) => $value / 100,
            set: fn (float $value) => (int) round($value * 100),
        );
    }

    public function getTotalInCents(): int
    {
        return $this->total * 100;
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }

    public function carrier(): BelongsTo
    {
        return $this->belongsTo(FreightCarrier::class);
    }

    public static function submit(
        int $addressId,
        ?int $cardId,
        string $deliveryTime,
        ?int $carrierId,
        ?string $notes,
    ): Order {
        $cart = auth()->user()->cart;

        $order = Order::create([
            'number' => Order::withTrashed()->count() + 10000,
            'user_id' => auth()->user()->id,
            'card_id' => $cardId ?? null,
            'address_id' => $addressId,
            'carrier_id' => $carrierId ?? null,
            'shipping_time' => $deliveryTime,
            'subtotal' => $cart->getSubtotal(),
            'shipping' => $cart->getShippingEstimate(),
            'tax' => $cart->getTaxEstimate(),
            'total' => $cart->getTotal(),
            'notes' => $notes,
        ]);

        foreach ($cart->items as $item) {
            $part = $item->part;
            OrderItem::create([
                'order_id' => $order->id,
                'sku' => $part->sku,
                'description' => $part->description,
                'quantity' => $item->quantity,
                'price' => $part->price,
                'part_id' => $part->id,
            ]);
        }

        Notification::route('mail', 'jason@southerngse.com')
            ->notify(new OrderReceivedNotification($order));
        $order->user->notify(new OrderPlacedNotification($order));

        $cart->empty();

        return $order;
    }

    public function process(array $data)
    {
        $this->updateItems($data);

        $this->update([
            'subtotal' => $subtotal = $this->getUpdatedSubtotal(),
            'tax' => $tax = $data['tax_amount'],
            'shipping' => $shipping = $data['shipping_amount'],
            'total' => $subtotal + $tax + $shipping,
            'tracking_number' => $data['tracking_number'],
            'closed_at' => now(),
        ]);

        Payment::charge($this, $this->getTotalInCents());

        $this->maybeCreateBackOrder();
    }

    protected function getUpdatedSubtotal()
    {
        return $this->items->reduce(function ($carry, $item) {
            return $carry + ($item->shipped_quantity * $item->price);
        });
    }

    protected function updateItems(array $data)
    {
        foreach($data as $key => $value) {
            if ($item = $this->items()->where('sku', $key)->first()) {
                $item->update(['shipped_quantity' => $value]);
            }
        }
    }

    protected function maybeCreateBackOrder(): void
    {
        if ($this->hasUnshippedItems()) {
            $backOrder = $this->createBackorder();
            $this->createBackOrderItems($backOrder);
            $this->calculate($backOrder);
        }
    }

    protected function hasUnshippedItems(): bool
    {
        $remainder = $this->items->reduce(function ($carry, $item) {
            return $carry + ($item->quantity - $item->shipped_quantity);
        });

        return $remainder ? true : false;
    }

    protected function createBackorder()
    {
        return Order::create([
            'number' => Order::withTrashed()->count() + 10000,
            'user_id' => $this->user_id,
            'card_id' => $this->card_id,
            'address_id' => $this->address_id,
            'carrier_id' => $this->carrier_id,
            'shipping_time' => $this->shipping_time,
            'notes' => $this->notes,
        ]);
    }

    protected function createBackOrderItems(Order $backOrder): void
    {
        $this->items->each(function ($item) use ($backOrder) {
            if ($quantity = $item->quantity - $item->shipped_quantity) {
                OrderItem::create([
                    'order_id' => $backOrder->id,
                    'sku' => $item->sku,
                    'description' => $item->description,
                    'quantity' => $quantity,
                    'price' => $item->price,
                    'part_id' => $item->part_id,
                ]);
            }
        });
    }

    protected function calculate(Order $backOrder)
    {
        $backOrder->update([
            'subtotal' => $this->getSubtotal(),
            'shipping' => $this->getShippingEstimate(),
            'tax' => $this->getTaxEstimate(),
            'total' => $this->getTotal(),
        ]);
    }
}

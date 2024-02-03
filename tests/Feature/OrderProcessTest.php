<?php

use App\Models\Address;
use App\Models\Card;
use App\Models\FreightCarrier;
use App\Models\Order;
use App\Models\Part;

beforeEach(function () {
    $this->setupAccount();
    createCard();
});

it('can process an entire order', function () {
    $part = Part::factory()->create([
        'price' => 20.00,
        'cost' => 10.00
    ]);

    expect($part)
        ->price->toEqual(20.00)
        ->cost->toEqual(10.00)
        ->and($part->getPriceInCents())->toEqual(2000);

    $this->actingAs($this->user);
    $this->user->cart->addItem($part);
    $this->user->cart->addItem($part);

    expect($order = createOrder())
        ->subtotal->toEqual(40)
        ->shipping->toEqual(25)
        ->total->toEqual(65);

    $order->process([
        $part->sku => 2,
        'tax_amount' => 2.40,
        'shipping_amount' => 21.00,
        'tracking_number' => '1Z322453343934934'
    ]);

    expect($order->fresh())
        ->subtotal->toEqual(40)
        ->tax->toEqual(2.40)
        ->shipping->toEqual(21.00)
        ->total->toEqual(63.40)
        ->tracking_number->toBe('1Z322453343934934')
        ->closed_at->notToBeNull;

    expect($order->items()->first())
        ->shipped_quantity->toBe(2);
});

it('can process a partial order with shipping all of one item', function () {
    $part1 = Part::factory()->create([
        'price' => 20.00,
        'cost' => 10.00
    ]);

    $part2 = Part::factory()->create([
        'price' => 50.00,
        'cost' => 0.00
    ]);

    $this->actingAs($this->user);
    $this->user->cart->addItem($part1);
    $this->user->cart->addItem($part1);
    $this->user->cart->addItem($part2);
    $this->user->cart->addItem($part2);

    $order = createOrder();

    expect(Order::count())->toBe(1);

    $order->process([
        $part1->sku => 2,
        'tax_amount' => 2.40,
        'shipping_amount' => 21.00,
        'tracking_number' => '1Z322453343934934'
    ]);

    expect($order->fresh())
        ->subtotal->toEqual(40)
        ->tax->toEqual(2.40)
        ->shipping->toEqual(21.00)
        ->total->toEqual(63.40)
        ->tracking_number->toBe('1Z322453343934934')
        ->closed_at->notToBeNull

    ->and($order->items()->first())
        ->shipped_quantity->toBe(2)

    ->and(Order::count())->toBe(2)
    ->and($backorder = Order::whereNull('closed_at')->first())
        ->number->toEqual($order->number + 1)
        ->user_id->toBe($this->user->id)
        ->card_id->toBe($order->card_id)
        ->address_id->toBe($order->address_id)
        ->carrier_id->toBe($order->carrier_id)
        ->shipping_time->toBe($order->shipping_time)
        ->notes->toBe($order->notes)
    ->and($backorder->items()->count())->toBe(1)
    ->and($backorder->items->first())
        ->order_id->toBe($backorder->id)
        ->sku->toEqual($part2->sku)
        ->description->toBe($part2->description)
        ->quantity->toBe(2)
        ->price->toEqual($part2->price)
        ->shipped_quantity->toBe(0)
        ->cancelled_at->toBeNull
        ->part_id->toBe($part2->id);
});

function createOrder()
{
    test()->actingAs(test()->user);

    $address = Address::factory()->create(['user_id' => test()->user->id]);
    $carrier = FreightCarrier::factory()->create(['user_id' => test()->user->id]);

    return Order::submit(
        addressId: $address->id,
        cardId: test()->card->id,
        deliveryTime: 'Ground',
        carrierId: $carrier->id,
        notes: 'Order Notes'
    );
}

function createCard()
{
    test()->card = Card::create([
        'stripe_id' => 'cus_PUpKbR5PXdAcqr',
        'last_four' => '4242',
        'brand' => 'Visa',
        'exp_month' => '04',
        'exp_year' => '2030',
        'user_id' => test()->user->id,
    ]);
}

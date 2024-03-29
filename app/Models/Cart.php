<?php

namespace App\Models;

use App\Concerns\HasItemAmounts;
use App\Contracts\Itemable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model implements Itemable
{
    use HasFactory;
    use HasItemAmounts;

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function addItem(Part $part): void
    {
        if (auth()->check()) {
            static::addToDatabase($part);
        } else {
            static::addToSession($part);
        }
    }

    protected static function addToDatabase(Part $part): void
    {
        $cart = auth()->user()->cart;

        if ($item = CartItem::where('cart_id', $cart->id)->where('part_id', $part->id)->first()) {
            $item->update(['quantity' => $item->quantity + 1]);
        } else {
            CartItem::create([
                'part_id' => $part->id,
                'cart_id' => $cart->id,
            ]);
        }
    }

    protected static function addToSession(Part $part): void
    {
        if ($cart = session()->get('cart')) {
            if (isset($cart[$part->id])) {
                $cart[$part->id] += $cart[$part->id];
            } else {
                $cart[$part->id] = 1;
            }

            session()->put('cart', $cart);
        } else {
            session()->put('cart', [
                $part->id => 1
            ]);
        }
    }

    public static function hasItems(): bool
    {
        if (auth()->check()) {
            return (bool) auth()->user()->cart->items()->count();
        } else {
            return (bool) count(session()->get('cart') ?? []);
        }
    }

    public function mergeStorageTypes(): void
    {
        $items = session()->get('cart');
        if (!$items) {
            return;
        }

        foreach ($items as $partId => $quantity) {
            if (!CartItem::where('part_id', $partId)->where('cart_id', $this->id)->count()) {
                CartItem::create([
                    'part_id' => $partId,
                    'cart_id' => $this->id,
                    'quantity' => $quantity,
                ]);
            }
        }

        session()->put('cart', []);
    }

    public function empty(): void
    {
        $this->items()->delete();
    }
}

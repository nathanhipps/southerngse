<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    public function part(): BelongsTo
    {
        return $this->belongsTo(Part::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn(int $value) => $value / 100,
            set: fn(float $value) => (int) round($value * 100),
        );
    }

    public function getPriceInCents(): int
    {
        return $this->price * 100;
    }
}

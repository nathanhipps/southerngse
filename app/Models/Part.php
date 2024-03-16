<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Part extends Model
{
    use HasFactory;

    protected $appends = [
        'display_price',
    ];

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

    protected function cost(): Attribute
    {
        return Attribute::make(
            get: fn(int|null $value) => $value ? $value / 100 : 0,
            set: fn(float $value) => (int) round($value * 100),
        );
    }

    public function categories(): MorphToMany
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function getDisplayPriceAttribute(): string
    {
        return '$'.number_format($this->price / 100, 2);
    }

    public function scopeSearch(Builder $query, string $search): Builder
    {
        return $query->where('sku', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%");
    }
}

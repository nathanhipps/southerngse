<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $appends = [
        'display_price',
    ];

    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    public function getDisplayPriceAttribute()
    {
        return '$'.number_format($this->price / 100, 2);
    }

    public function scopeSearch(Builder $query, string $search)
    {
        return $query->where('sku', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%");
    }
}

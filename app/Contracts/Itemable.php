<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\HasMany;

interface Itemable
{
    public function items(): HasMany;
}

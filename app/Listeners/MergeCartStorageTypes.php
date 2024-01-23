<?php

namespace App\Listeners;

class MergeCartStorageTypes
{
    public function __construct()
    {

    }

    public function handle(): void
    {
        auth()->user()->cart->mergeStorageTypes();
    }
}

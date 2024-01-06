<?php

namespace App\Listeners;

class MergeCartStorageTypes
{
    public function __construct()
    {

    }

    public function handle(object $event): void
    {
        auth()->user()->cart->mergeStorageTypes();
    }
}

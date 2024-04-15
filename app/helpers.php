<?php

use Illuminate\Support\Number;

function displayCurrency($number): string
{
    return Number::currency($number);
}

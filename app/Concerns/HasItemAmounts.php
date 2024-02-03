<?php

namespace App\Concerns;

trait HasItemAmounts
{
    public function getSubtotal()
    {
        return $this->items()->with('part')->get()
            ->reduce(function ($carry, $item) {
                return $carry + $item->quantity * $item->part->price;
            }, 0);
    }

    public function getShippingEstimate()
    {
        $subtotal = $this->getSubtotal();

        if ($subtotal == 0) {
            return 0;
        }

        if ($subtotal < 500) {
            return 25;
        }

        return $subtotal * .05;
    }

    public function getTaxEstimate()
    {
        return 0;
    }

    public function getTotal()
    {
        return $this->getSubtotal() + $this->getShippingEstimate() + $this->getTaxEstimate();
    }
}

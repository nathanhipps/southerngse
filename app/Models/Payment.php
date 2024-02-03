<?php

namespace App\Models;

use Stripe\Charge;
use Stripe\Stripe;
use Stripe\Refund;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public static function charge($order, $amount)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $card = Card::find($order->card_id);

        $charge = new static;

        $charge->order_id = $order->id;
        $charge->card_id  = $order->card_id;
        $charge->amount   = $amount;

        try {
            $response = Charge::create([
                "amount" => $amount,
                "currency" => "USD",
                "customer" => $card->stripe_id,
                "description" => $order->number
            ]);

            $charge->gateway_id = $response->id;

            return $charge->save();

        } catch (\Exception $e) {
            return false;
        }
    }

    public function refund($amount = null)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // If no amount is given, assume a full refund of remaining charges
        if (! $amount) {
            $order = Order::find($this->order_id);
            $amount = $order->totalCharges();
        }

        try {
            $response = Refund::create([
                "charge" => $this->gateway_id,
                "amount" => $amount,
            ]);

            $payment = new static;
            $payment->gateway_id = $response->id;
            $payment->amount = $response->amount * -1;
            $payment->order_id = $this->order_id;
            $payment->card_id = $this->card_id;

            $this->refunded_amount += $amount;
            $this->save();

            return $payment->save();

        } catch (\Exception $e) {
            return false;
        }
    }
}

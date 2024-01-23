<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $hidden = ['stripe_id'];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public static function createFromInput(array $data, User $user = null): static
    {
        $card = new static;

        if (!$user) {
            $user = auth()->user();
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create([
            'source' => $data['id'],
            'email'  => $user->email,
            'description' => $user->id . ' - ' . $user->company . ', ' . $user->name
        ]);

        $card->stripe_id = $customer->id;
        $card->last_four = $data['card']['last4'];
        $card->brand     = $data['card']['brand'];
        $card->exp_month = $data['card']['exp_month'];
        $card->exp_year  = $data['card']['exp_year'];
        $card->user_id   = $user->id;

        $card->save();

        return $card;
    }

    public static function getDeclinedCard(User $user)
    {
        $card = new static;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Customer::create([
            'source' => 'tok_chargeCustomerFail',
            'email'  => auth()->user()->email,
            'description' => auth()->user()->id . ' - ' . auth()->user()->company . ', ' . auth()->user()->name
        ]);

        $card->stripe_id = $customer->id;
        $card->last_four = '0002';
        $card->brand     = 'Visa';
        $card->exp_month = 2;
        $card->exp_year  = 2024;
        $card->user_id   = $user->id;

        $card->save();

        return $card;
    }

    public function charge(int $amount, array $options = []): Charge
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $charge = Charge::create([
            "amount" => $amount,
            'currency' => 'usd',
            'customer' => $this->stripe_id,
            'description' => $options['description'] ?? ''
        ]);

        return $charge;
    }
}

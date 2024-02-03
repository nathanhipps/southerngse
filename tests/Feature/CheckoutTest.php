<?php

use App\Livewire\Checkout\Index;
use App\Models\Address;
use App\Models\Card;
use App\Models\FreightCarrier;
use App\Models\Part;
use App\Notifications\Admin\OrderReceivedNotification;
use App\Notifications\Customer\OrderPlacedNotification;
use Illuminate\Support\Facades\Notification;

beforeEach(fn () => $this->setupAccount());

it('can not be visited if there are no cart items', function () {
    $this
        ->actingAs($this->user)
        ->get('checkout')
        ->assertRedirect('/');
});

it('can not be visited if not logged in', function () {
    $this
        ->get('checkout')
        ->assertRedirect('login');
});

it('sets up properly', function () {
    $this->actingAs($this->user);

    $part = Part::factory()->create();

    $this->user->cart->addItem($part);

    Livewire::test(Index::class)
        ->assertSee($part->sku)
        ->assertSee($part->description)
        ->assertSet('action', '')
        ->assertMethodWired('startAction')
        ->assertSet('address_id', '')
        ->assertPropertyWired('address_id')
        ->assertSet('carrier_id', '')
        ->assertSee('UPS')
        ->assertSet('card_id', '')
        ->assertPropertyWired('card_id')
        ->assertSet('deliveryTime', '')
        ->assertPropertyWired('deliveryTime')
        ->assertSet('slider', false)
        ->assertPropertyWired('slider')
        ->assertSet('cart.id', $this->user->cart->id)
        ->assertSet('notes', '')
        ->assertPropertyWired('notes')
        ->assertSee('disabled');
});

it('uses defaults if only one selection', function () {
    $this->actingAs($this->user);

    $part = Part::factory()->create();

    $this->user->cart->addItem($part);

    $card = Card::factory()->create(['user_id' => $this->user->id]);
    $address = Address::factory()->create(['user_id' => $this->user->id]);
    $carrier = FreightCarrier::factory()->create(['user_id' => $this->user->id]);

    Livewire::test(Index::class)
        ->assertSet('address_id', $address->id)
        ->assertSet('carrier_id', $carrier->id)
        ->assertPropertyWired('carrier_id')
        ->assertSet('card_id', $card->id);
});

it('can process an order', function () {
    Notification::fake();

    $this->actingAs($this->user);

    $part = Part::factory()->create();

    $this->user->cart->addItem($part);

    $card = Card::factory()->create(['user_id' => $this->user->id]);
    $address = Address::factory()->create(['user_id' => $this->user->id]);
    $carrier = FreightCarrier::factory()->create(['user_id' => $this->user->id]);

    expect($this->user->orders()->count())->toBe(0);

    Livewire::test(Index::class)
        ->set('address_id', $address->id)
        ->set('card_id', $card->id)
        ->set('carrier_id', $carrier->id)
        ->set('deliveryTime', 'Ground')
        ->set('notes', 'These are some notes')
        ->call('submit')
        ->assertDispatched(
            'notify',
            title: 'Success',
            message: 'Your order has been received'
        )
        ->assertRedirect(route('account'));

    $this->user->cart->addItem($part);

    expect($this->user->orders()->count())->toBe(1)
        ->and($order = $this->user->orders()->first())
        ->number->toEqual(10000)
        ->user_id->toBe($this->user->id)
        ->card_id->toBe($card->id)
        ->address_id->toBe($address->id)
        ->carrier_id->toBe($carrier->id)
        ->shipping_time->toBe('Ground')
        ->subtotal->toEqual($this->user->cart->getSubtotal())
        ->shipping->toEqual($this->user->cart->getShippingEstimate())
        ->tax->toEqual($this->user->cart->getTaxEstimate())
        ->total->toEqual($this->user->cart->getTotal())
        ->notes->toBe('These are some notes')
        ->tracking_number->toBeNull
        ->closed_at->toBeNull
        ->and($order->items()->first())
        ->order_id->toBe($order->id)
        ->sku->toEqual($part->sku)
        ->description->toBe($part->description)
        ->quantity->toBe(1)
        ->price->toBe($part->price)
        ->part_id->toBe($part->id)
        ->cancelled_at->toBeNull
        ->shipped_quantity->toBe(0);

    Notification::assertSentTimes(OrderReceivedNotification::class, 1);
    Notification::assertSentTo($order->user, OrderPlacedNotification::class);
});

it('can process an order without a carrier', function () {
    Notification::fake();

    $this->actingAs($this->user);

    $part = Part::factory()->create();

    $this->user->cart->addItem($part);

    $card = Card::factory()->create(['user_id' => $this->user->id]);
    $address = Address::factory()->create(['user_id' => $this->user->id]);

    expect($this->user->orders()->count())->toBe(0);

    Livewire::test(Index::class)
        ->set('address_id', $address->id)
        ->set('card_id', $card->id)
        ->assertSet('carrier_id', '')
        ->set('deliveryTime', 'Ground')
        ->set('notes', 'These are some notes')
        ->call('submit')
        ->assertDispatched(
            'notify',
            title: 'Success',
            message: 'Your order has been received'
        )
        ->assertRedirect(route('account'));

    $this->user->cart->addItem($part);

    expect($this->user->orders()->count())->toBe(1)
        ->and($order = $this->user->orders()->first())
        ->number->toEqual(10000)
        ->user_id->toBe($this->user->id)
        ->card_id->toBe($card->id)
        ->address_id->toBe($address->id)
        ->carrier_id->toBeNull
        ->shipping_time->toBe('Ground')
        ->subtotal->toEqual($this->user->cart->getSubtotal())
        ->shipping->toEqual(round($this->user->cart->getShippingEstimate(), 2))
        ->tax->toEqual($this->user->cart->getTaxEstimate())
        ->total->toEqual($this->user->cart->getTotal())
        ->notes->toBe('These are some notes')
        ->tracking_number->toBeNull
        ->closed_at->toBeNull
        ->and($order->items()->first())
        ->order_id->toBe($order->id)
        ->sku->toEqual($part->sku)
        ->description->toBe($part->description)
        ->quantity->toBe(1)
        ->price->toBe($part->price)
        ->part_id->toBe($part->id)
        ->cancelled_at->toBeNull
        ->shipped_quantity->toBe(0);
});

<?php

use App\Http\Controllers\ImageController;
use App\Livewire\Account\Index as AccountIndex;
use App\Livewire\Account\OrderShow;
use App\Livewire\Cart\Show as CartShow;
use App\Livewire\Checkout\Index as CheckoutIndex;
use App\Livewire\Manual\Index as ManualsIndex;
use App\Livewire\Parts\Index as PartsIndex;
use App\Livewire\UsedEquipment;
use Illuminate\Support\Facades\Route;

Route::get('/preview', function () {
    $order = App\Models\Order::first();

    return (new App\Notifications\Admin\OrderReceivedNotification($order))
        ->toMail($order->user);
});

Route::get('/images/{filename}', [ImageController::class, 'show'])
    ->name('image')
    ->where('filename', '.*');
Route::get('equipment/used', UsedEquipment::class)->name('equipment-used');
Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/contact-us', 'pages.contact')->name('contact');
Route::get('/parts', PartsIndex::class)->name('parts');
Route::get('/manuals', ManualsIndex::class)->name('manuals');
Route::get('/cart', CartShow::class)->name('cart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/account', AccountIndex::class)->name('account');
    Route::get('/checkout', CheckoutIndex::class)->name('checkout');
    Route::get('/orders/{order}', OrderShow::class)->name('order');
});

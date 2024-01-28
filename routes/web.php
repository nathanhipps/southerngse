<?php

use App\Http\Controllers\ImageController;
use App\Livewire\Account\Index as AccountIndex;
use App\Livewire\Cart\Show as CartShow;
use App\Livewire\Checkout\Index as CheckoutIndex;
use App\Livewire\Parts\Index as PartsIndex;
use Illuminate\Support\Facades\Route;

route::get('/images/{filename}', [ImageController::class, 'show'])
    ->name('image')
    ->where('filename', '.*');
Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/contact-us', 'pages.contact')->name('contact');
Route::view('/about', 'pages.about')->name('about');
Route::view('/test', 'pages.test')->name('test');
Route::get('/parts', PartsIndex::class)->name('parts');
Route::get('/cart', CartShow::class)->name('cart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/account', AccountIndex::class)->name('account');
    Route::get('/checkout', CheckoutIndex::class)->name('checkout');
});

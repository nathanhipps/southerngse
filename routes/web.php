<?php

use App\Livewire\Account\Index as AccountIndex;
use App\Livewire\Parts\Index as PartsIndex;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/services', 'pages.services')->name('services');
Route::view('/contact-us', 'pages.contact')->name('contact');
Route::view('/about', 'pages.about')->name('about');
Route::view('/test', 'pages.test')->name('test');
Route::get('/parts', PartsIndex::class)->name('parts');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/account', AccountIndex::class)->name('account');
});

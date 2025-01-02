<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/onas', function () {
    return view('aboutus');
});

Route::get('/ogloszenia', [OffersController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('offers.index');

Route::get('/ogloszenia/dodaj', [OffersController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('offers.create');

Route::get('/ogloszenia/edytuj', [OffersController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('offers.edit');

Route::get('/ogloszenia/wyswietl', [OffersController::class, 'single'])
    ->middleware(['auth', 'verified'])->name('offers.single');

Route::get('/ogloszenia/moje', [OffersController::class, 'user'])
    ->middleware(['auth', 'verified'])->name('offers.user');

Route::get('/ogloszenia/ulubione', [OffersController::class, 'favorite'])
    ->middleware(['auth', 'verified'])->name('offers.favorite');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

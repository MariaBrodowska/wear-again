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

Route::get('/ogloszenia', [OffersController::class, 'index'])->name('offers.index');

Route::get('/ogloszenia/moje', [OffersController::class, 'user'])->name('offers.user');

Route::get('/ogloszenia/dodaj', [OffersController::class, 'create'])->name('offers.create');

Route::post('/ogloszenia/zapisz', [OffersController::class, 'store'])->name('offers.store');

Route::get('/ogloszenia/edytuj/{id}', [OffersController::class, 'edit'])->name('offers.edit');

Route::put('offers/zmien/{id}', [OffersController::class, 'update'])->name('offers.update');

Route::delete('offers/usun/{id}', [OffersController::class, 'delete'])->name('offers.delete');

Route::get('/offers/{id}', [OffersController::class, 'show'])->name('offers.show');

Route::get('/ogloszenia/ulubione', [OffersController::class, 'favorite'])
    ->middleware(['auth', 'verified'])->name('offers.favorite');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

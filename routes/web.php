<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\CategorySearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/onas', function () {
    return view('aboutus');
});

Route::get('/ogloszenia/ulubione', [FavoriteController::class, 'favorite'])
    ->middleware(['auth', 'verified'])->name('offers.favorite');

Route::post('/ulubione/zmien', [FavoriteController::class, 'changeFavorite'])
    ->middleware(['auth', 'verified'])->name('favorites.change');

Route::get('/ogloszenia', [CategorySearchController::class, 'index'])->name('offers.index');
Route::get('/użytkownicy', [CategorySearchController::class, 'index'])->name('users.index');

Route::get('/ogloszenia/moje', [OffersController::class, 'user'])
    ->middleware(['auth', 'verified'])->name('offers.user');

Route::get('/ogloszenia/dodaj', [OffersController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('offers.create');

Route::post('/ogloszenia/zapisz', [OffersController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('offers.store');

Route::get('/ogloszenia/edytuj/{id}', [OffersController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('offers.edit');

Route::put('ogloszenia/zmien/{id}', [OffersController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('offers.update');

Route::delete('ogloszenia/usun/{id}', [OffersController::class, 'delete'])
    ->middleware(['auth', 'verified'])->name('offers.delete');

Route::get('/ogloszenia/{id}', [OffersController::class, 'show'])->name('offers.show');
Route::get('/uzytkownicy/{id}', [UsersController::class, 'show'])->name('users.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

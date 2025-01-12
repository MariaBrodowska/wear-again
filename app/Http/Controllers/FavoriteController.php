<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{//dodawanie do ulubioonych, wysiwetlanie ulubionych, usuwnaie z ulubionych
    public function favorite(){
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $offers = Offer::whereIn('id', $favorites->pluck('offer_id'))->get();
        return view('offers.favorite', ['offers' => $offers]);
    }
}

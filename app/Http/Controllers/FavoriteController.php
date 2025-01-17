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
        $favorites = Favorite::where('user_id', Auth::id());
        $offers = Offer::whereIn('id', $favorites->pluck('offer_id'))->paginate(6);
        return view('offers.favorite', ['offers' => $offers]);
    }
    public function changeFavorite(Request $request){
        $existing = Favorite::where('user_id', Auth::id())
            ->where('offer_id', $request->id)->first();
        if($existing){
            $existing->delete();
            return redirect()->route('offers.index')->with('message', 'Ogłoszenie zostało usunięte z ulubionych');
        }
        else{
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->offer_id = $request->id;
            $favorite->save();
            return redirect()->route('offers.index')->with('message', 'Ogłoszenie zostało dodane do ulubionych');
        }
    }
}

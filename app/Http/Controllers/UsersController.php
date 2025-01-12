<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{//wysiwetlanie profilu, wyswieltanie listy oferty dla uzytkownika, edytowanie profilu
    public function show($id){
        $user = User::find($id);
        $offers = Offer::where('seller_id', $id)->get();
        $reviews = Review::where('seller_id', $id)->get();
        $average = $reviews->avg('rating');
        $count = $reviews->count();
        return view('users.single', compact('user', 'offers', 'reviews', 'average', 'count'));
    }
}

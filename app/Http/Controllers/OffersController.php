<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Offer;

class OffersController extends Controller
{
    public function index(){
        $offers = Offer::all(); //pobieramy wszystkie rekordy z tabeli offers

        return view('offers.index', ['offers' => $offers]);
    }
    public function create(){
        $categories = Category::all();
        return view('offers.create', ['categories' => $categories]);
    }
    public function edit(){
        return view('offers.edit');
    }
        public function single(){
        return view('offers.single');
    }
    public function user(){
        return view('offers.user');
    }
    public function favorite(){
        return view('offers.favorite');
    }

}

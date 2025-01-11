<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{//dodawanie nowych, edytowanie, usuwanie, wyswietlanie pojedynczej
    public function index(Request $request){
        $offers = Offer::all(); //pobieramy wszystkie rekordy z tabeli offers
        $categories = Category::all();
        $sizes = Size::all();
        $query = Offer::query();

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('sort')) {
            switch ($request->input('sort')) {
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
            }
        }
        $offers = $query;
        return view('offers.index', compact('offers','categories','sizes'));
    }
    public function create(){
        $categories = Category::all();
        $sizes = Size::all();
        return view('offers.create', ['categories' => $categories], ['sizes' => $sizes]);
    }
    public function store(Request $request){
        $offer = new Offer();
        $offer->seller_id = Auth::id();
        $offer->name = $request->title;
        $offer->description = $request->description;
        $offer->size_id = $request->size;
        $offer->category_id = $request->category;
        $offer->price = $request->price;
        $offer->condition= $request->condition;
        $offer->image_path = $request->photo;
        $offer->save();
        return redirect()->route('offers.user')->with('message', 'Ogłoszenie dodane poprawnie');
    }
    public function edit(){
        return view('offers.edit');
    }
    public function update(){
    }
    public function user(){
        $offers = Offer::where('seller_id', Auth::id())->get();
        return view('offers.user', ['offers' => $offers]);
    }
    public function favorite(){
        return view('offers.favorite');
    }
    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        if ($offer->user_id !== Auth::id()) {
            abort(403, 'Brak dostępu do tego ogłoszenia');
        }
        $offer->delete();
        return redirect()->route('offers.user')->with('success', 'Ogłoszenie zostało usunięte.');
    }
}

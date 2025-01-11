<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Models\Offer;
use Illuminate\Support\Facades\Auth;

class OffersController extends Controller
{//dodawanie nowych, edytowanie, usuwanie, wyswietlanie pojedynczej
    public function create(){ //dodawanie
        $categories = Category::all();
        $sizes = Size::all();
        return view('offers.create', ['categories' => $categories], ['sizes' => $sizes]);
    }
    public function store(Request $request){ //zapis dodanej
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
    public function edit($id){ //edytowanie
        $offer = Offer::find($id);
        $categories = Category::all();
        $sizes = Size::all();
        return view('offers.edit', compact('offer','categories','sizes'));
    }
    public function update($id, Request $request){ //zapis edytowanej
        $offer = Offer::find($id);
        $offer->name = $request->title;
        $offer->description = $request->description;
        $offer->size_id = $request->size;
        $offer->category_id = $request->category;
        $offer->price = $request->price;
        $offer->condition= $request->condition;
        if($request->photo!="") {
            $offer->image_path = $request->photo;
        }
        $offer->save();
        return redirect()->route('offers.user')->with('message', 'Ogłoszenie zaktualizowane poprawnie');
    }
    public function delete($id){ //usuwanie
        Offer::destroy($id);
        return redirect()->route('offers.user')->with('message', 'Ogłoszenie zostało usunięte');
    }
    public function user(){ //wyswietlanie moich
        $offers = Offer::where('seller_id', Auth::id())->get();
        return view('offers.user', ['offers' => $offers]);
    }
    public function show($id){ //wyswietlanie pojedynczej
        $offer = Offer::findOrFail($id);
        return view('offers.single', ['offer' => $offer]);
    }

}

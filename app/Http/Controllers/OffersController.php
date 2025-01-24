<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
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
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'size' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|string',
        ], [
            'title.required' => 'Tytuł jest wymagany.',
            'title.string' => 'Tytuł musi być ciągiem tekstowym.',
            'title.max' => 'Tytuł nie może być dłuższy niż 255 znaków.',
            'description.string' => 'Opis musi być ciągiem tekstowym.',
            'description.max' => 'Opis nie może być dłuższy niż 1000 znaków.',
            'size.required' => 'Wybór rozmiaru jest wymagany.',
            'category.required' => 'Wybór kategorii jest wymagany.',
            'price.required' => 'Cena jest wymagana.',
            'price.numeric' => 'Cena musi być liczbą.',
            'price.min' => 'Cena nie może być mniejsza niż 0.',
            'condition.required' => 'Stan jest wymagany.',
            'condition.string' => 'Stan musi być ciągiem tekstowym.',
        ]);

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'size' => 'required',
            'category' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|string',
        ], [
            'title.required' => 'Tytuł jest wymagany.',
            'title.string' => 'Tytuł musi być ciągiem tekstowym.',
            'title.max' => 'Tytuł nie może być dłuższy niż 255 znaków.',
            'description.string' => 'Opis musi być ciągiem tekstowym.',
            'description.max' => 'Opis nie może być dłuższy niż 1000 znaków.',
            'size.required' => 'Wybór rozmiaru jest wymagany.',
            'category.required' => 'Wybór kategorii jest wymagany.',
            'price.required' => 'Cena jest wymagana.',
            'price.numeric' => 'Cena musi być liczbą.',
            'price.min' => 'Cena nie może być mniejsza niż 0.',
            'condition.required' => 'Stan jest wymagany.',
            'condition.string' => 'Stan musi być ciągiem tekstowym.',
        ]);
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
        $offers = Offer::where('seller_id', Auth::id())->paginate(6);
        return view('offers.user', compact('offers'));
    }
    public function show($id){ //wyswietlanie pojedynczej
        $offer = Offer::find($id);
        return view('offers.single', compact('offer',));
    }


}

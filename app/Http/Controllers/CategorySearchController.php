<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\Size;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategorySearchController extends Controller
{//filtrowanie ofert, wyszukiwanie, kategorie
    public function index(Request $request){
        $categories = Category::all();
        $sizes = Size::all();
        $query = Offer::query();
        $userQuery = User::query();
        $users = User::all();
        $searchType = $request->input('search_type', 'items');

        $request->validate([
            'category' => 'nullable',
            'size' => 'nullable',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'date_from' => 'nullable|date',
            'date_to' => 'nullable|date',
            'query' => 'nullable|string|max:255',
            'sort' => 'nullable|in:newest,oldest,price_low,price_high',
        ], [
            'category.exists' => 'Wybrana kategoria nie istnieje.',
            'size.exists' => 'Wybrany rozmiar nie istnieje.',
            'min_price.numeric' => 'Cena minimalna musi być liczbą.',
            'min_price.min' => 'Cena minimalna nie może być mniejsza niż 0.',
            'max_price.numeric' => 'Cena maksymalna musi być liczbą.',
            'max_price.min' => 'Cena maksymalna nie może być mniejsza niż 0.',
            'max_price.gte' => 'Cena maksymalna musi być większa lub równa cenie minimalnej.',
            'date_from.date' => 'Data początkowa musi być poprawnym formatem daty.',
            'date_from.before_or_equal' => 'Data początkowa nie może być późniejsza niż data końcowa.',
            'date_to.date' => 'Data końcowa musi być poprawnym formatem daty.',
            'date_to.after_or_equal' => 'Data końcowa nie może być wcześniejsza niż data początkowa.',
            'query.string' => 'Zapytanie wyszukiwania musi być tekstem.',
            'query.max' => 'Zapytanie wyszukiwania może mieć maksymalnie 255 znaków.',
            'sort.in' => 'Nieprawidłowa opcja sortowania.',
        ]);

        if($searchType == 'items') {
            if ($request->filled('category')) {
                $query->where('category_id', $request->category);
            }
            if ($request->filled('size')) {
                $query->where('size_id', $request->size);
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
            if ($request->filled('query')) {
                $query->where('name', 'like', '%' . $request->input('query') . '%')
                    ->orWhere('description', 'like', '%' . $request->input('query') . '%');
            }
            $offers = $query->paginate(6);
            return view('offers.index', compact('offers','categories','sizes','users'));
        }
        else{
            if ($request->filled('query')) {
                $userQuery->where('name', 'like', '%' . $request->input('query') . '%')
                    ->orWhere('email', 'like', '%' . $request->input('query') . '%');
            }
            $users = $userQuery->paginate(6);
            return view('users.index', compact('users', 'searchType', 'categories', 'sizes'));
        }
    }
}

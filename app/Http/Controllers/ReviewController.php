<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Review;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class ReviewController extends Controller{
    public function add(Request $request, $id){
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Ocena jest wymagana.',
            'rating.integer' => 'Ocena musi być liczbą całkowitą.',
            'rating.min' => 'Ocena musi być większa lub równa 1.',
            'rating.max' => 'Ocena nie może być większa niż 5.',
            'review.string' => 'Komentarz musi być tekstem.',
            'review.max' => 'Komentarz nie może mieć więcej niż 1000 znaków.',
        ]);
            $order = Order::find($id);
            $offer = Offer::where('order_id', $id)->get()->first();
            $existingReview = Review::where('seller_id', $offer->user_id)->where('buyer_id', Auth::id());
            if ($existingReview) {
                return redirect()->route('orders.single', ['id' => $order->id])->with('message', 'Już dodałeś opinię.');
            }
            $review = new Review();
            $review->seller_id = $offer->seller_id;
            $review->buyer_id = Auth::id();
            $review->rating = $request->rating;
            $review->comment = $request->review;
            $review->save();
        return redirect()->route('orders.single', ['id' => $order->id])->with('message', 'Twoja opinia została zapisana.');
    }

    public function update(Request $request, $id){
        $request->validate([
            'rating' => 'required|numeric|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'Ocena jest wymagana.',
            'rating.integer' => 'Ocena musi być liczbą całkowitą.',
            'rating.min' => 'Ocena musi być większa lub równa 1.',
            'rating.max' => 'Ocena nie może być większa niż 5.',
            'review.string' => 'Komentarz musi być tekstem.',
            'review.max' => 'Komentarz nie może mieć więcej niż 1000 znaków.',
        ]);
        $order = Order::find($id);
        $offer = Offer::where('order_id', $id)->get()->first();
        $existingReview = Review::where('seller_id', $offer->seller_id)->where('buyer_id', Auth::id())->first();
        $existingReview->comment = $request->review;
        $existingReview->rating = $request->rating;
        $existingReview->save();
        return redirect()->route('orders.single', ['id' => $order->id])->with('message', 'Twoja opinia została zaktualizowana.');
    }
}

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
            $order = Order::find($id);
            $offer = Offer::where('order_id', $id)->get()->first();
            error_log($offer);
            $review = new Review();
            $review->seller_id = $offer->seller_id;
            $review->buyer_id = Auth::id();
            $review->rating = $request->rating;
            $review->comment = $request->review;
            $review->save();
        return redirect()->route('orders.single', ['id' => $order->id])->with('message', 'Twoja opinia została zapisana.');
    }

    public function update(Request $request, $id){
        $order = Order::find($id);
        $offer = Offer::where('order_id', $id)->get()->first();
        error_log($offer->seller_id);
        error_log($order->buyer_id);
        $existingReview = Review::where('seller_id', $offer->seller_id)->where('buyer_id', Auth::id())->get()->first();
        $existingReview->comment = $request->review;
        $existingReview->rating = $request->rating;
        $existingReview->save();
        return redirect()->route('orders.single', ['id' => $order->id])->with('message', 'Twoja opinia została zaktualizowana.');
    }
}

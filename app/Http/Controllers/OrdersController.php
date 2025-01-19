<?php

namespace App\Http\Controllers;

use App\Models\Delivery_Method;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Payment_Method;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    public function index($id){
        $offer = Offer::find($id);
        $deliveries = Delivery_Method::all();
        $payments = Payment_Method::all();
//        error_log($payments);
//        error_log($deliveries);
        return view('orders.index', compact('offer','deliveries','payments'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'city' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'delivery_method' => 'required|exists:delivery__methods,id',
            'payment_method' => 'required|exists:payment__methods,id',
        ]);
        $offer = Offer::find($request->offer_id);
        if($offer->status == 'sprzedane'){
            return redirect()->route('orders.show')->with('message', 'Złożenie zamówienia nie powiodło się.');
        }
        $delivery = Delivery_Method::find($request->delivery_method);
        $payment = Payment_Method::find($request->payment_method);
        $totalPrice = $offer->price + $delivery->price;
        $order = new Order();
        $order->buyer_id = Auth::id();
        $order->delivery_method_id = $delivery->id;
        $order->payment_method_id = $payment->id;
        $order->total_price = $totalPrice;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone ?? null;
        $order->address = $request->address;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->notes = $request->notes ?? null;
        $order->save();
        $offer->status = 'sprzedany';
        $offer->order_id = $order->id;
        $offer->save();
        return redirect()->route('orders.show', ['order' => $order->id])->with('message', 'Zamówienie zostało pomyślnie złożone!');
    }

    public function show(){
        $orders = Order::where('buyer_id', Auth::id())->get();
        $count = count($orders);
        return view('orders.show', compact('orders','count'));
    }

    public function single($id){
        $order = Order::where('id', $id)->where('buyer_id', Auth::id())->get()->first();
        $count = Order::where('buyer_id', Auth::id())->count();
        $offer = Offer::where('order_id', $id)->get()->first();
        return view('orders.single', compact('order','count','offer'));
    }

}

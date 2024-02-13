<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function checkout()
    {
        return view('checkout');
    }
    public function createOrder(Request $request)
    {
        $carts = Cart::where('user_id')->get();
        $add =  Address::create([
            'address_line1' => $request->address,
            'country' => $request->shipping_country,
            'state' => $request->shipping_state,
            'city' => $request->shipping_city,
            'pin' => $request->shipping_postcode,
        ]);

        $order = Order::create([
            'user_id' => Auth::user()->id,
            'payment_id' => 1,
            'billing_add_id' => $add->id,
            'shipping_add_id' => $add->id,
            'amount' => $add->id,
            'status_id' => 1,

        ]);
        foreach ($carts as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->amount,
                'ring_size' => $item->ring_size,
                'metal_quality' => $item->ring_size,
            ]);
        }
        $details = [];
        Mail::to(Auth::user()->email)->send(new \App\Mail\SendMail($details));
        return redirect()->route('thanks');
    }
}

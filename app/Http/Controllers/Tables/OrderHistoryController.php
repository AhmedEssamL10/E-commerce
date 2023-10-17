<?php

namespace App\Http\Controllers\Tables;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\order_history;
use App\Mail\OrderDetails;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderHistoryController extends Controller
{
    public function create()
    {
        $carts = Cart::all(); // Assuming you have a Cart model
        $cartData = [];
        foreach ($carts as $cart) {
            $order =  order_history::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
            $cartData[] = $order;
        }
        Mail::to(Auth::user()->email)->send(new OrderDetails($cartData));
        Cart::where('user_id', '=', Auth::user()->id)->delete();
        return redirect(route('home'))->with('success', 'your order has been requested');
    }
    public function index()
    {
        $orders = order_history::where('user_id', Auth::user()->id)->with('product')->orderBy('created_at', 'desc')->paginate(5);
        return view('Pages.profile', compact('orders'));
    }
}

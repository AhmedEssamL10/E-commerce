<?php

namespace App\Http\Controllers\Tables;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\order_history;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    //
    public function create()
    {
        $carts = Cart::all(); // Assuming you have a Cart model

        foreach ($carts as $cart) {
            order_history::create([
                'user_id' => $cart->user_id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
            ]);
        }
        Cart::where('user_id', '=', Auth::user()->id)->delete();
        return redirect(route('home'))->with('success', 'your order has been requested');
    }
    public function index()
    {
        $orders = order_history::where('user_id', Auth::user()->id)->with('product')->orderBy('created_at', 'desc')->paginate(5);
        return view('Pages.profile', compact('orders'));
    }
}

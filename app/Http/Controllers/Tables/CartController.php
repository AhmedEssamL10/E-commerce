<?php

namespace App\Http\Controllers\Tables;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function cart($product_id, Request $request)
    {

        $product = Product::where('id', '=', $product_id)->first();
        Cart::create([
            'user_id' => Auth::user()->id,
            'product_id' => $product->id,
            // 'quantity' => $request->quantity
        ]);
        return view('Pages.cart', compact('product'));
    }
}

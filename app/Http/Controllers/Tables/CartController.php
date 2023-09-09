<?php

namespace App\Http\Controllers\Tables;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Routing\Route;
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
        return redirect(route('shop'));
    }
    public function index()
    {
        # code...

        $cartInfo = Cart::select('*')->where('user_id', '=', Auth::user()->id)->get();
        $products = [];
        foreach ($cartInfo as  $value) {
            $product = Product::where('id', '=', $value->product_id)->get();
            $products[] = $product;
        }
        // dd($products);
        return view('Pages.cart', compact('cartInfo', 'products'));
    }
    public function delete($product_id)
    {
        Cart::where('product_id', '=', $product_id)->delete();
        return redirect(route('cart'));
    }
}

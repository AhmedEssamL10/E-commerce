<?php

namespace App\Http\Controllers\Tables;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return back();
    }
    public function index()
    {
        # code...

        $cartInfo = Cart::select('*')->where('user_id', '=', Auth::user()->id)->get();

        // $products = [];
        // foreach ($cartInfo as  $value) {
        //     $product = Product::where('id', '=', $value->product_id)->get();
        //     $products[] = $product;
        $products = DB::table('users')->join('carts',  'carts.user_id', '=', "users.id")
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.*', 'carts.quantity')->where('carts.user_id', '=', Auth::user()->id)->get();


        // dd($products);
        return view('Pages.cart', compact('products'));
    }
    public function delete($product_id)
    {
        Cart::where('product_id', '=', $product_id)->delete();
        return redirect(route('cart'));
    }
    public function edit($product_id, Request $request)
    {
        Cart::where('product_id', '=', $product_id)->update([
            'quantity' => $request->quantity
        ]);
        return redirect(route('cart'));
    }
}

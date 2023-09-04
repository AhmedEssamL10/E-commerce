<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        return view('Pages.shop', compact('products'));
    }
    public function filterByBrands($brand_id)
    {
        $products = Product::where('brand_id', '=', $brand_id)->get();
        return view('Pages.shop', compact('products'));
    }
}

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
        $products = Product::paginate(5);
        // $products = Product::all();
        return view('Pages.shop', compact('products'));
    }
    public function filterByBrands($brand_id)
    {
        $products = Product::where('brand_id', '=', $brand_id)->get();
        return view('Pages.shop', compact('products'));
    }
    public function filterByCategories($category_id)
    {
        // DB::table('catigories')->join('subcatigories','')
        $products = Product::where('category_id', '=', $category_id)->get();
        return view('Pages.shop', compact('products'));
    }
    public function filterBySubategories($subcategory_id)
    {
        $products = Product::where('subcategory_id', '=', $subcategory_id)->get();
        return view('Pages.shop', compact('products'));
    }
    public function product_details($product_id)
    {
        $product = Product::where('id', '=', $product_id)->first();
        $products = Product::where('subcategory_id', '=', $product->subcategory_id)->get();
        return view('Pages.single-product', compact('product', 'products'));
    }
}

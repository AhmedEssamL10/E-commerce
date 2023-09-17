<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller


{
    //
    public function index()
    {
        $brands = Brand::where('en_name', '!=', 'none')->get();
        $newProduct = Product::select('image', 'en_name', 'en_details')->orderBy('created_at')->first();
        return view('welcome', compact('newProduct', 'brands'));
    }
}

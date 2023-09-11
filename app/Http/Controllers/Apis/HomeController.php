<?php

namespace App\Http\Controllers\Apis;


use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\Subcatigory;
use App\Traits\ApiResponses;

class HomeController extends Controller
{

    use ApiResponses;
    public function index()
    {
        $brands = Brand::all();
        $newProduct = Product::select('image', 'en_name', 'en_details')->orderBy('created_at')->first();
        $categories = Catigory::select('en_name', 'id')->get();
        $subcategories = Subcatigory::select('en_name', 'id')->get();
        // return response()->json(compact('brands', 'newProduct', 'categories', 'subcategories'));
        return $this->data(compact('brands', 'newProduct', 'categories', 'subcategories'), 'done');
    }
}
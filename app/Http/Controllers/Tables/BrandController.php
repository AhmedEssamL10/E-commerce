<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catigory;
use App\Models\Product;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index()
    {

        $brands = Brand::all();
        return view('welcome', compact('brands', 'newProduct'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Catigory;
use Illuminate\Http\Request;

class HomeController extends Controller


{
    //
    public function index()
    {
        $brands = Brand::all();
        $categories = Catigory::all();
        return view('welcome', compact('categories', 'brands'));
    }
    public function indexcategory()
    {
    }
}

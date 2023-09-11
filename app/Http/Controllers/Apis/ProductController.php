<?php

namespace App\Http\Controllers\Apis;


use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $products = Product::all();

        return $this->data(compact('products'), 'done');
    }
}

<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Favorate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavorateController extends Controller
{
    public function index()
    {
        $favorateProducts = Product::select('image', 'en_name', 'price', 'products.id')->join('favorates', 'favorates.product_id', 'products.id')
            ->where('favorates.user_id', '=', Auth::user()->id)->get();
        return view('Pages.favorate', compact('favorateProducts'));
    }
    public function create($id)
    {
        Favorate::create([
            'user_id' => Auth::user()->id,
            'product_id' => $id
        ]);
        return back();
    }
    public function delete($id)
    {
        Favorate::where('product_id', '=', $id)->delete();
        return back();
    }
}

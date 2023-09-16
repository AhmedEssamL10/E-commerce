<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Catigory;
use App\Models\Subcatigory;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // $products = Product::all();
        $products = Product::all();
        return view('admin.CRUD.Product.index', compact('products'));
    }
    public function create()
    {
        $brands = Brand::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = Subcatigory::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        return view('admin.CRUD.Product.create', compact('brands', 'subcatigories'));
    }
    public function store(StoreProductRequest $request)
    {
        //upload image
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'product-' . uniqid() . '.' . $extention;
            $path = public_path('images/product');
            $image->move($path, $imageName);
        }
        // insert into database
        Product::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
            'en_details' => $request->en_details,
            'ar_details' => $request->ar_details,
            'code' => $request->code,
            'brand_id' => $request->brands_id,
            'subcategory_id' => $request->subcatigories_id,
            'image' => $imageName,

        ]);
        //redirect
        return  redirect(route('products.index'))->with('success', 'the product create successfully');
    }
}

<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Subcatigory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Models\Catigory;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.CRUD.Product.index', compact('products'));
    }

    public function create()
    {
        $brands = Brand::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = Subcatigory::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $catigories = Catigory::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        return view('admin.CRUD.Product.create', compact('brands', 'subcatigories', 'catigories'));
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
            'category_id' => $request->catigories_id,
            'image' => $imageName,

        ]);
        //redirect
        return  redirect(route('products.index'))->with('success', 'the product create successfully');
    }

    public function edit($id)
    {
        $brands = Brand::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $subcatigories = Subcatigory::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $catigories = Catigory::select('id', 'en_name', 'ar_name')->orderBy('en_name')->get();
        $products = Product::where('id', '=', $id)->get();
        return view('admin.CRUD.Product.edit', compact('products', 'brands', 'subcatigories', 'catigories'));
    }

    public function update(Request $request, $id)
    {
        //validation
        $validation = $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'quantity' => 'required|max:3',
            'status' => 'in:0,1',
            'price' => 'required|max:6',
            'en_details' => 'required|max:255',
            'ar_details' => 'required|max:255',
            'code' => "required|integer|unique:products,code,$id,id",
            'brand_id' => 'integer|exists:brands,id',
            'subcategory_id' => 'integer|exists:subcatigories,id',
            'category_id' => 'integer|exists:catigories,id',
            'image' => 'image'
        ]);

        //upload image
        $dbimage = Product::select('image')->where('id', '=', $id)->first();
        $imageName = $dbimage->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'product-' . uniqid() . '.' . $extention;
            $path = public_path('images\product');
            $dbimage =  Product::select('image')->where('id', '=', $id)->first();
            $oldpath1 = $path . '\\' . $dbimage->image;
            if (file_exists($oldpath1)) {
                unlink($oldpath1);
            }

            $image->move($path, $imageName);
        }
        // update database
        Product::where('id', '=', $id)->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'quantity' => $request->quantity,
            'status' => $request->status,
            'price' => $request->price,
            'en_details' => $request->en_details,
            'ar_details' => $request->ar_details,
            'code' => $request->code,
            'brand_id' => $request->brand_id,
            'subcategory_id' => $request->subcategory_id,
            'category_id' => $request->catigories_id,
            'image' => $imageName,
        ]);
        //redirect
        return  redirect(route('products.index'))->with('success', 'the product Updated successfully');
    }

    public function delete($id)
    {

        $path = public_path('images\product');
        $dbimage = Product::select('image')->where('id', '=', $id)->first();
        $oldpath1 = $path . '\\' . $dbimage->image;
        if (file_exists($oldpath1)) {
            unlink($oldpath1);
        }

        Product::where('id', '=', $id)->delete();
        return  back()->with('success', 'the product deleted successfully');
    }
}

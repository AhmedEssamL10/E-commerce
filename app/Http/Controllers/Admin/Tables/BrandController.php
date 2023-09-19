<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index()
    {
        $brands = Brand::all();
        return view('admin.CRUD.Brand.index', compact('brands'));
    }
    public function create()
    {
        return view('admin.CRUD.Brand.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1',
            'image' => 'required|image'
        ]);
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'brand-' . uniqid() . '.' . $extention;
            $path = public_path('images/brand-logo');
            $image->move($path, $imageName);
        }
        Brand::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
            'image' => $imageName,
        ]);
        return redirect(route('brands.index'))->with('success', 'the brand create successfully');
    }
    // public function edit($id)
    // {
    //     $brands = DB::table('brands')->where('id', '=', $id)->first();
    //     return view('CRUD.Brands.edit', compact('brands'));
    // }
}

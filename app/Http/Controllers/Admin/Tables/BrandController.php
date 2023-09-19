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
    public function edit($id)
    {
        $brands = Brand::where('id', '=', $id)->first();
        return view('admin.CRUD.Brand.edit', compact('brands'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1',
            'image' => 'image'
        ]);
        $dbimage = Brand::select('image')->where('id', '=', $id)->first();
        $imageName = $dbimage->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'brands-' . uniqid() . '.' . $extention;
            $path = public_path('images\brand-logo');
            $dbimage = Brand::select('image')->where('id', '=', $id)->first();
            $oldpath1 = $path . '\\' . $dbimage->image;
            if (file_exists($oldpath1)) {
                unlink($oldpath1);
            }
            $image->move($path, $imageName);
        }
        Brand::where('id', '=', $id)->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
            'image' => $imageName,
        ]);
        return  redirect(route('brands.index'))->with('success', 'the brand updated successfully');
    }
    public function delete($id)
    {
        $path = public_path('images\brand-logo');
        $dbimage = Brand::select('image')->where('id', '=', $id)->first();
        $oldpath1 = $path . '\\' . $dbimage->image;
        if (file_exists($oldpath1)) {
            unlink($oldpath1);
        }

        Brand::where('id', '=', $id)->delete();
        return back()->with('success', 'the brand deleted successfully');
    }
}

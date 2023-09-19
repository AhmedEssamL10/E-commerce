<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $catigories = Catigory::all();
        return view('admin.CRUD.Category.index', compact('catigories'));
    }
    public function create()
    {
        return view('admin.CRUD.Category.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1'
        ]);
        Catigory::create([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
        ]);
        return redirect(route('catigories.index'))->with('success', 'the brand created successfully');
    }
    public function edit($id)
    {
        $catigories = Catigory::where('id', '=', $id)->first();
        return view('admin.CRUD.Category.edit', compact('catigories'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'en_name' => 'required|max:32',
            'ar_name' => 'required|max:32',
            'status' => 'required|in:0,1'
        ]);
        Catigory::where('id', '=', $id)->update([
            'en_name' => $request->en_name,
            'ar_name' => $request->ar_name,
            'status' => $request->status,
        ]);
        return redirect(route('catigories.index'))->with('success', 'the brand updated successfully');
    }
    public function delete($id)
    {
        Catigory::where('id', '=', $id)->delete();
        return redirect(route('catigories.index'))->with('success', 'the brand deleted successfully');
    }
}

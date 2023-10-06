<?php

namespace App\Http\Controllers\Admin\Tables;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    //
    public function index()
    {
        $news = News::all();
        return view('admin.CRUD.news.index', compact('news'));
    }
    public function create()
    {
        return view('admin.CRUD.news.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:32',
            'desc' => 'required',
            'image' => 'required|image'
        ]);
        $imageName = '';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'news-' . uniqid() . '.' . $extention;
            $path = public_path('images/News');
            $image->move($path, $imageName);
        }
        News::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'admin_id' => Auth::guard('admin')->user()->id,
            'image' => $imageName,
        ]);
        return redirect(route('admin.news.index'))->with('success', 'the news create successfully');
    }
    public function edit($id)
    {
        $news = News::where('id', '=', $id)->first();
        return view('admin.CRUD.news.edit', compact('news'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:32',
            'desc' => 'required',
            'image' => 'image'
        ]);
        $dbimage = news::select('image')->where('id', '=', $id)->first();
        $imageName = $dbimage->image;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extention = $image->getClientOriginalExtension();
            $imageName = 'news-' . uniqid() . '.' . $extention;
            $path = public_path('images\News');
            $dbimage = news::select('image')->where('id', '=', $id)->first();
            $oldpath1 = $path . '\\' . $dbimage->image;
            if (file_exists($oldpath1)) {
                unlink($oldpath1);
            }
            $image->move($path, $imageName);
        }
        News::where('id', '=', $id)->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'admin_id' => Auth::guard('admin')->user()->id,
            'image' => $imageName,
        ]);
        return  redirect(route('admin.news.index'))->with('success', 'the News updated successfully');
    }
    public function delete($id)
    {
        $path = public_path('images\News');
        $dbimage = News::select('image')->where('id', '=', $id)->first();
        $oldpath1 = $path . '\\' . $dbimage->image;
        if (file_exists($oldpath1)) {
            unlink($oldpath1);
        }

        News::where('id', '=', $id)->delete();
        return back()->with('success', 'the News deleted successfully');
    }
}

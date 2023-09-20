<?php

namespace App\Http\Controllers\Tables;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function index()
    {
        return view('Pages.contact');
    }
    public function create(Request $request)
    {
        //validation
        $request->validate([
            'name' => 'required|string|max:32',
            'email' => 'required|email',
            'phone' => 'required|string|max:11',
            'subject' => 'required|max:100',
            'message' => 'required'
        ]);
        //create
        Complaint::create([
            'user_name' => $request->name,
            'user_email' => $request->email,
            'user_phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ]);
        return back()->with('success', 'Your complanit is send success');
    }
}

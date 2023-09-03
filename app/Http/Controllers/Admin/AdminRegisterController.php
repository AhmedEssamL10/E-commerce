<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    //
    public function register()
    {
        return view('admin.auth.register');
    }
    public function store(Request $request)
    {
        $adminKey = 'ahmed220123';
        if ($request->admin_key == $adminKey) {
            $request->validate([
                'name' => 'required|string|max:32',
                'email' => 'required|email',
                'phone' => 'required|string|max:11|min:11',
                'password' => 'required|string|min:8|confirmed',
                'admin_key' => 'required|string',
                'password_confirmation' => 'required|string'

            ]);
            Admin::create([
                'name' => $request->name,
                'email' =>  $request->email,
                'phone' =>  $request->phone,
                'password' => Hash::make($request->password),
            ]);

            redirect(route('dashboard.admin.login'));
        } else
            return back()->with('error', 'Something went wrong');
    }
}

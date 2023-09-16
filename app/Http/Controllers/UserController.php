<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function changePassword(Request $request)
    {

        if (Hash::check($request->old_password, Auth::user()->password)) {
            $request->validate([
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'
            ]);
            User::where('id', '=', Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            Auth::logout();
            return redirect(route('login'));
        } else
            return back()->with('error', 'something went wrong');
    }
}

<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponses;
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'device_name' => 'required'
        ]);
        $user = User::where('email', $request->email)->first();
        if (!Hash::check($request->password, $user->password)) {
            return $this->error(['email' => 'wrong email or password'], 'wrong info', '401');
        }
        $user->token = 'bearer ' . $user->createToken($request->device_name)->plainTextToken;
        return $this->data(compact('user'));
    }
}

<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        //verification
        return $this->data(compact('user'));
    }
    public function logoutFromAllDevices(Request $request)
    {
        //  $AuthUser = Auth::guard('sanctum')->user()
        $AuthUser = $request->user('sanctum');
        $AuthUser->tokens()->delete();
        return $this->success('all user dedvices is logout');
    }
    public function logout(Request $request)
    {
        $AuthUser = $request->user('sanctum');
        $token = $request->header('Authorization');
        $tokenExp = explode('|', substr($token, 7));
        $tokenId = $tokenExp[0];
        $AuthUser->tokens()->where('id', $tokenId)->delete();
        return $this->success("Current Device Has Been Logged Out Successfully");
    }
}
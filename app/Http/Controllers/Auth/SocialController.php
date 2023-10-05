<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function redirectToFaceBook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleGoogleCallback()
    {

        $user = Socialite::driver('google')->user();
        // dd('user');
        $finduser = User::where('social_id', $user->id)->first();
        if ($finduser) {
            Auth::login($finduser);
            return redirect(route('home'));
        } else {
            $newuser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'email_verified_at' => now(),
                'social_id' => $user->id,
                'social_type' => 'google',
                'password' => Hash::make('my-google'),
            ]);
            Auth::Login($newuser);
            return redirect(route('home'));
        }
    }
    // public function handleFacebookCallback()
    // {

    //     $user = Socialite::driver(driver: 'facebook')->user();
    //     $finduser = User::where('social_id', $user->id)->first();
    //     if ($finduser) {
    //         Auth::login($finduser);
    //         return response()->json($finduser);
    //     } else {
    //         $newuser = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'phone' => $user->phone,
    //             'social_id' => $user->id,
    //             'social_type' => 'facebook',
    //             'password' => Hash::make('my-facebook')
    //         ]);
    //         Auth::Login($newuser);
    //         return redirect(route('home'));
    //     }
    // }
}
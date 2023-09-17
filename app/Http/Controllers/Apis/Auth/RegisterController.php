<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    use ApiResponses;
    public function __invoke(Request $request)
    {

        //validation
        $request->validate([
            'name' => 'required|string|max:32',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|min:11|max:11',
            'device_name' => 'required'
        ]);
        //hash password and create
        $data = $request->except('password', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $user->token = 'Bearer' . $user->createToken($request->device_name)->plainTextToken;
        return $this->data(compact('user'), 'done');
    }
}

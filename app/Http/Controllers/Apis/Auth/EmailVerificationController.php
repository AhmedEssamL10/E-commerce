<?php

namespace App\Http\Controllers\Apis\Auth;

use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use App\Mail\EmailVerificationCode;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmailVerificationController extends Controller
{
    use ApiResponses;
    public function sendCode(Request $request)
    {
        //token
        $token = $request->header('Authorization');
        //get user
        $authUser = Auth::guard('sanctum')->user();
        //generate code
        $code = rand(10000, 99999);
        //generate exporation date
        // dd(date('Y-m-d H:i:s'));
        $expirationDate =  date('Y-m-d H:i:s', strtotime('+2 minutes')); //date of now + two mentues
        //save code and expiration date in database
        $user =  User::find($authUser->id);
        $user->code = $code;
        $user->code_expired_at = $expirationDate;
        $user->save();
        $user->token = $token;
        //send mail
        Mail::to($user->email)->send(new EmailVerificationCode($user));
        //return user data
        return $this->data(compact('user'));
    }
    public function checkCode(Request $request)
    {
        //token
        $token = $request->header('Authorization');
        $authUser = Auth::guard('sanctum')->user();
        //code
        //validation
        $request->validate([
            'code' => 'required|digits:5|exists:users'
        ]);
        $user =  User::find($authUser->id);
        //check code
        if ($user->code == $request->code && $user->code_expired_at > date('Y-m-d H:i:s')) {
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();
        } else {
            //update email verified at
            return $this->error(['code' => 'invalid'], 'faild attempt', 401);
        }
        $user->token = $token;
        return $this->data(compact('user'));
    }
}
<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    use ApiResponses;
    public function handle(Request $request, Closure $next)
    {

        $user = Auth::guard('sanctum')->user();
        if (is_null($user) || is_null($user->email_verified_at)) {
            return $this->error(['token' => 'token invalid'], 'unauthorized');
        }
        return $next($request);
    }
}

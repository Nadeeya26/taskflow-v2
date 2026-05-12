<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtpVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && !Auth::user()->is_verified) {
            if (!$request->routeIs('otp.*') && !$request->routeIs('logout')) {
                return redirect()->route('otp.show');
            }
        }
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware\Auth;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Http;

class UserActivityMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // check user is ban or not
        if (Auth::check()) {
            if (Auth::user()->status == 0) {
                Auth::guard('web')->logout();
                session()->invalidate();
                return redirect('login')->withErrors(['Ban' => 'Your account is banned. Either contact our team or use another email']);
            }
        }
        // check if user is online or not
        if (Auth::check()) {
            $expireAt = Carbon::now()->addMinutes(1);
            Cache::put('User-is-Online' . Auth::user()->id, true, $expireAt);
        }
        return $next($request);
    }
}

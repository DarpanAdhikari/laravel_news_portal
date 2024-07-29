<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;

class HasAnyPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        if (Auth::check()) {
            $permissions = Permission::all();
            if (Auth::user()->hasAnyPermission($permissions)){
                return $next($request);
            }
        }
        return abort(401);
    }
}

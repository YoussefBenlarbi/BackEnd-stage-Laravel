<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        return response()->json([
            'error' => 'You do not have permission to access this page.',
            "is_Admin" => Auth::user()->is_admin,
            "check" => Auth::check()
        ], 403);
    }
}

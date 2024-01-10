<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            // User is authenticated, check the role
            if (Auth::user()->role === $role) {
                return $next($request);
            } else {
                return redirect('/')->with('error', 'You don\'t have permission to access this page.');
            }
        }

        // User is not authenticated, redirect to login
        return redirect('/login');
    }
}

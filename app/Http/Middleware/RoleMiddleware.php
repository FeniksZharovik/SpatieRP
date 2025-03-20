<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = Auth::user();

        // Jika tidak login atau role tidak sesuai, redirect ke login
        if (!$user || $user->role !== $role) {
            return redirect()->route('login')->with('error', 'Access denied!');
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        if (Auth::user()->role !== $role) {
            abort(403, 'Unauthorized access - Only ' . ucfirst($role) . 's can access this section.');
        }

        return $next($request);
    }
}

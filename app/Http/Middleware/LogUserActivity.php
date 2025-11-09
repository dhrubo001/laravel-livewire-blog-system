<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\UserActivity;

class LogUserActivity
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        try {
            if (Auth::check()) {
                UserActivity::create([
                    'user_id' => Auth::id(),
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                ]);
            }
        } catch (\Throwable $e) {
            Log::error('User activity logging failed: ' . $e->getMessage());
        }

        return $response;
    }
}

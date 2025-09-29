<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $admin = auth()->guard('admin')->user();
        if (!$admin instanceof \App\Models\Admin) {
            auth()->guard('admin')->logout();
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}

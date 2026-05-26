<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectByRole
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($request->path() === 'dashboard') {
                if ($role === 'admin') {
                    return redirect('/admin/dashboard');
                } elseif ($role === 'farmer') {
                    return redirect('/farmer/dashboard');
                }
            }
        }

        return $next($request);
    }
}
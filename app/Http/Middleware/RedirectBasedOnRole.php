<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $role = auth()->user()->role;

            if ($role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($role === 'penjual') {
                return redirect()->route('penjual.dashboard');
            } elseif ($role === 'pembeli') {
                return redirect()->route('pembeli.dashboard');
            }
        }

        return $next($request);
    }
}
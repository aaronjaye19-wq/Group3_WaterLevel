<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is not authenticated, redirect to login
        if (!auth()->check()) {
            return redirect('/login');
        }

        // If user is not admin, return 403 Forbidden
        if (!auth()->user()->is_admin) {
            abort(403, 'Unauthorized access. You do not have permission to access the admin dashboard.');
        }

        return $next($request);
    }
}

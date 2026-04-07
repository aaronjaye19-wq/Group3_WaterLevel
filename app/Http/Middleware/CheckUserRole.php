<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
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

        // If user is admin, they should not access user dashboard - return 403
        if (auth()->user()->is_admin) {
            abort(403, 'Unauthorized access. Admins cannot access the user dashboard.');
        }

        return $next($request);
    }
}

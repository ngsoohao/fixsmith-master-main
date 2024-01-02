<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    
    public function handle($request, Closure $next, $allowedRoles)
    {
        // Check if the user has any of the allowed roles
        if (Auth::check() && $this->hasPermission(Auth::user()->role, $allowedRoles)) {
            return $next($request);
        } else {
            // Redirect or return an error response based on your requirements
            return redirect('/')->with('alert', 'Unauthorized Access');
        }
    }

    private function hasPermission($userRole, $allowedRoles)
    {
        // Check if the user role is in the allowed roles
        return in_array($userRole, explode('|', $allowedRoles));
    }
}


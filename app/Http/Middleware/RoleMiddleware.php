<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;
        
        // Map integer roles to string (1: patient, 2: doctor, 3: admin)
        $roleMap = [
            1 => 'patient',
            2 => 'doctor',
            3 => 'admin',
        ];

        // Get the current user's role as a string
        $currentRoleStr = is_numeric($userRole) ? ($roleMap[$userRole] ?? 'patient') : strtolower($userRole);

        // Check if the user has the required role
        if ($currentRoleStr !== $role) {
            // If they don't have permission, show 403 Forbidden error
            abort(403, 'Unauthorized action. You do not have permission to access this area.');
        }

        return $next($request);
    }
}
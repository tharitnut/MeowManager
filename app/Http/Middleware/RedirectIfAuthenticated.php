<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * If already logged in, redirect users based on their role/position.
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user(); // UserModel
                if ($user?->role === 'Member') {
                    return redirect('/member/dashboard');
                }
                if ($user?->role === 'Employee') {
                    $pos = optional($user->employee)->position; // Admin | Staff
                    return $pos === 'Admin'
                        ? redirect('/admin/dashboard')
                        : redirect('/staff/dashboard');
                }
                return redirect('/'); // fallback
            }
        }

        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnforceAccess
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();                        // tbl_users
        $role = $user->role ?? null;                 // 'Employee' or 'Member'
        $pos  = optional($user->employee)->position; // 'Admin'|'Staff'|null

        $allowed = array_map(fn($r) => strtolower(trim($r)), $roles);

        $isAdmin  = ($role === 'Employee' && $pos === 'Admin');
        $isStaff  = ($role === 'Employee' && $pos === 'Staff');
        $isMember = ($role === 'Member');

        $map = [
            'admin'  => $isAdmin,
            'staff'  => $isStaff,
            'member' => $isMember,
        ];

        foreach ($allowed as $key) {
            if (!empty($map[$key])) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized.');
    }
}
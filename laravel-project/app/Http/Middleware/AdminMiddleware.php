<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->session()->get('user_id');
        if (!$userId) {
            return redirect()->guest('/admin/login');
        }

        // Accept either primary role_id or user_roles table
        $user = \DB::table('users')->where('id', $userId)->first();
        if (!$user) {
            return redirect()->guest('/admin/login');
        }

        $isAdmin = false;
        if (!empty($user->role_id)) {
            $isAdmin = \DB::table('roles')->where('id', $user->role_id)->where('name', 'admin')->exists();
        }
        if (!$isAdmin) {
            $isAdmin = \DB::table('user_roles')
                ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->where('user_roles.user_id', $user->id)
                ->where('roles.name', 'admin')
                ->exists();
        }

        if (!$isAdmin) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}



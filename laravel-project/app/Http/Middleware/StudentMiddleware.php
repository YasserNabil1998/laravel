<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // student session key
        $userId = $request->session()->get('student_user_id');
        if (!$userId) {
            return redirect()->guest('/student/login');
        }

        $user = \DB::table('users')->where('id', $userId)->first();
        if (!$user) {
            return redirect()->guest('/student/login');
        }

        $isStudent = false;
        if (!empty($user->role_id)) {
            $isStudent = \DB::table('roles')->where('id', $user->role_id)->where('name', 'student')->exists();
        }
        if (!$isStudent) {
            $isStudent = \DB::table('user_roles')
                ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->where('user_roles.user_id', $user->id)
                ->where('roles.name', 'student')
                ->exists();
        }

        if (!$isStudent) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}



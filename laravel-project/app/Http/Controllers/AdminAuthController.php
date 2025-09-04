<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = DB::table('users')->where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->withErrors(['email' => 'الحساب غير موجود'])->withInput();
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['password' => 'كلمة المرور غير صحيحة'])->withInput();
        }

        // Ensure admin role
        $isAdmin = false;
        if (!empty($user->role_id)) {
            $isAdmin = DB::table('roles')->where('id', $user->role_id)->where('name', 'admin')->exists();
        }
        if (!$isAdmin) {
            $isAdmin = DB::table('user_roles')
                ->join('roles', 'user_roles.role_id', '=', 'roles.id')
                ->where('user_roles.user_id', $user->id)
                ->where('roles.name', 'admin')
                ->exists();
        }
        if (!$isAdmin) {
            return back()->withErrors(['email' => 'لا تملك صلاحيات الأدمن'])->withInput();
        }

        // Log in manually using session
        $request->session()->put('user_id', $user->id);
        $request->session()->migrate(true);

        return redirect()->intended('/admin');
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}



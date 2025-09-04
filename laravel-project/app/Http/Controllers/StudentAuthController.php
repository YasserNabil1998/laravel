<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        return view('student.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        $user = DB::table('users')->where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
        }

        // ensure student role
        $isStudent = false;
        if (!empty($user->role_id)) {
            $isStudent = DB::table('roles')->where('id', $user->role_id)->where('name', 'student')->exists();
        }
        if (!$isStudent) {
            $isStudent = DB::table('user_roles')->join('roles','user_roles.role_id','=','roles.id')->where('user_roles.user_id',$user->id)->where('roles.name','student')->exists();
        }
        if (!$isStudent) {
            return back()->withErrors(['email' => 'هذا الحساب ليس طالباً'])->withInput();
        }

        $request->session()->put('student_user_id', $user->id);
        $request->session()->migrate(true);
        return redirect()->intended('/student');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('student_user_id');
        $request->session()->regenerateToken();
        return redirect('/student/login');
    }
}



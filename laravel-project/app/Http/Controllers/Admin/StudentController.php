<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user')->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100'],
            'email' => ['required','email','unique:users,email'],
            'password' => ['required','string','min:6'],
            'phone' => ['nullable','string','max:30'],
            'student_id' => ['required','string','max:50','unique:students,student_id'],
            'department' => ['nullable','string','max:100'],
            'level' => ['nullable','string','max:50'],
            'semester' => ['nullable','string','max:50'],
            'enrollment_date' => ['nullable','date'],
            'is_active' => ['nullable','boolean'],
        ]);

        $studentRoleId = DB::table('roles')->where('name', 'student')->value('id');
        $userId = DB::table('users')->insertGetId([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role_id' => $studentRoleId,
            'is_active' => $validated['is_active'] ?? true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Student::create([
            'user_id' => $userId,
            'student_id' => $validated['student_id'],
            'department' => $validated['department'] ?? null,
            'level' => $validated['level'] ?? null,
            'semester' => $validated['semester'] ?? null,
            'enrollment_date' => $validated['enrollment_date'] ?? null,
            'is_active' => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('admin.students.index')->with('success','تم إضافة الطالب');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        return view('admin.students.edit', ['id' => $id, 'student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validate([
            'department' => ['nullable','string','max:100'],
            'level' => ['nullable','string','max:50'],
            'semester' => ['nullable','string','max:50'],
            'enrollment_date' => ['nullable','date'],
            'is_active' => ['nullable','boolean'],
        ]);
        $student->update($data);
        return redirect()->route('admin.students.index')->with('success','تم تحديث بيانات الطالب');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('admin.students.index')->with('success','تم حذف الطالب');
    }
}

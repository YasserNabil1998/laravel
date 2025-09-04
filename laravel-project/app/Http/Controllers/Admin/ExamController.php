<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::latest()->paginate(10);
        return view('admin.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'duration_minutes' => ['required','integer','min:1'],
            'total_questions' => ['required','integer','min:1'],
            'passing_score' => ['required','integer','min:0'],
            'start_time' => ['nullable','date'],
            'end_time' => ['nullable','date','after_or_equal:start_time'],
            'is_active' => ['nullable','boolean'],
            'is_published' => ['nullable','boolean'],
        ]);
        $data['created_by'] = auth()->id() ?? 1;
        Exam::create($data);
        return redirect()->route('admin.exams.index')->with('success','تم إنشاء الاختبار');
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
        $exam = Exam::findOrFail($id);
        return view('admin.exams.edit', compact('exam','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $exam = Exam::findOrFail($id);
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'duration_minutes' => ['required','integer','min:1'],
            'total_questions' => ['required','integer','min:1'],
            'passing_score' => ['required','integer','min:0'],
            'start_time' => ['nullable','date'],
            'end_time' => ['nullable','date','after_or_equal:start_time'],
            'is_active' => ['nullable','boolean'],
            'is_published' => ['nullable','boolean'],
        ]);
        $exam->update($data);
        return redirect()->route('admin.exams.index')->with('success','تم تحديث الاختبار');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $exam = Exam::findOrFail($id);
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success','تم حذف الاختبار');
    }
}

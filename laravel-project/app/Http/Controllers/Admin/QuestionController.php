<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questions = Question::latest()->paginate(10);
        return view('admin.questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exams = Exam::orderBy('title')->get(['id','title']);
        return view('admin.questions.create', compact('exams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'exam_id' => ['nullable','exists:exams,id'],
            'question_text' => ['required','string'],
            'question_type' => ['required','in:multiple_choice,true_false,essay'],
            'options' => ['nullable','array'],
            'correct_answer' => ['required','string'],
            'points' => ['required','integer','min:1'],
            'order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);
        // default exam_id = null allowed; if you want, set to first active exam later
        Question::create($data);
        return redirect()->route('admin.questions.index')->with('success','تم إضافة السؤال');
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
        $question = Question::findOrFail($id);
        $exams = Exam::orderBy('title')->get(['id','title']);
        return view('admin.questions.edit', compact('id','question','exams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $question = Question::findOrFail($id);
        $data = $request->validate([
            'question_text' => ['required','string'],
            'question_type' => ['required','in:multiple_choice,true_false,essay'],
            'options' => ['nullable','array'],
            'correct_answer' => ['required','string'],
            'points' => ['required','integer','min:1'],
            'order' => ['nullable','integer','min:0'],
            'is_active' => ['nullable','boolean'],
        ]);
        $question->update($data);
        return redirect()->route('admin.questions.index')->with('success','تم تحديث السؤال');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect()->route('admin.questions.index')->with('success','تم حذف السؤال');
    }
}

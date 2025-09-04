<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalStudents = DB::table('students')->count();
        $availableQuestions = DB::table('questions')->where('is_active', true)->count();
        $activeExams = DB::table('exams')->where('is_active', true)->count();

        $totalResults = DB::table('exam_results')->count();
        $passedResults = DB::table('exam_results')->where('status', 'passed')->count();
        $passRate = $totalResults > 0 ? round(($passedResults / $totalResults) * 100) : 0;

        return view('admin.dashboard', [
            'metrics' => [
                'totalStudents' => $totalStudents,
                'availableQuestions' => $availableQuestions,
                'activeExams' => $activeExams,
                'passRate' => $passRate,
            ],
        ]);
    }
}

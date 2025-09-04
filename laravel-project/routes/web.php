<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\DashboardController;

// Admin auth
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Student auth
use App\Http\Controllers\StudentAuthController;
Route::get('/student/login', [StudentAuthController::class, 'showLogin'])->name('student.login');
Route::post('/student/login', [StudentAuthController::class, 'login']);
Route::post('/student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

// Admin routes (protected by admin middleware)
Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', DashboardController::class)->name('admin.dashboard');
    // Students (resource)
    Route::resource('students', StudentController::class)->names('admin.students');

    // Questions (resource)
    Route::resource('questions', QuestionController::class)->names('admin.questions');
    Route::get('/exams', fn () => view('admin.exams.index'))->name('admin.exams.index');
    Route::resource('exams', ExamController::class)->names('admin.exams');
    Route::get('/reports', fn () => view('admin.reports.index'))->name('admin.reports.index');
    Route::get('/settings', fn () => view('admin.settings.index'))->name('admin.settings.index');
});

// Student routes (protected)
Route::prefix('student')->middleware('student')->group(function () {
    Route::get('/', fn () => view('student.dashboard'))->name('student.dashboard');
});

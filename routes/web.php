<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

// Landing Page
Route::get('/', function () {
    return view('landing'); // Adjust view name as necessary
});


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');














// Admin Routes - Admin Role Required
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/manage-users', [AdminController::class, 'manageUsers'])->name('admin.manageUsers');
    Route::get('/admin/manage-marks', [AdminController::class, 'manageMarks'])->name('admin.manageMarks');
    Route::post('/admin/verify-user/{id}', [AdminController::class, 'verifyUser'])->name('admin.verifyUser');
    Route::post('/admin/subjects', [AdminController::class, 'addSubject'])->name('admin.addSubject');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
});




// Teacher Routes - Teacher Role Required
Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');



    Route::get('/teacher/view-students', [TeacherController::class, 'viewStudents'])->name('teacher.viewStudents');
    Route::get('/teacher/view-subjects', [TeacherController::class, 'viewSubjects'])->name('teacher.viewSubjects');
    Route::post('/teacher/update-marks/{studentId}', [TeacherController::class, 'updateMarks'])->name('teacher.updateMarks');
    Route::post('/teacher/predict/{studentId}', [PredictionController::class, 'predictMarks'])->name('teacher.predictMarks');


    Route::get('/teacher/subject/{id}', [TeacherController::class, 'viewSubjectDetails'])->name('teacher.viewSubjectDetails');
    Route::get('/teacher/subject/{subject}/students', [TeacherController::class, 'viewStudentDetails'])
        ->name('teacher.viewStudentDetails');

    Route::put('/marks/{id}', [MarkController::class, 'update'])->name('marks.update');
});




// Student Routes - Student Role Required
Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/student/view-subjects', [StudentController::class, 'viewSubjects'])->name('student.viewSubjects');
    Route::get('/student/view-marks', [StudentController::class, 'viewMarks'])->name('student.viewMarks');
    Route::post('/student/predict/{subject}', [PredictionController::class, 'predictMarks'])->name('student.predictMarks');
    Route::get('/student/profile', [StudentController::class, 'profile'])->name('student.profile');
    Route::get('/student/support', [StudentController::class, 'support'])->name('student.support');
});




// Subject Routes - Admin and Teacher Access
Route::middleware(['auth', 'role:admin|teacher'])->group(function () {
    Route::get('/subjects', [SubjectController::class, 'index'])->name('subjects.index');
    Route::post('/subjects/store', [SubjectController::class, 'store'])->name('subjects.store');
    Route::get('/subjects/{id}', [SubjectController::class, 'show'])->name('subjects.show');
    Route::put('/subjects/{id}', [SubjectController::class, 'update'])->name('subjects.update');
    Route::delete('/subjects/{id}', [SubjectController::class, 'destroy'])->name('subjects.destroy');
});



// Mark Routes - Admin and Teacher Access
Route::middleware(['auth', 'role:admin|teacher'])->group(function () {
    Route::get('/marks', [MarkController::class, 'index'])->name('marks.index');
    Route::get('/marks/{studentId}', [MarkController::class, 'show'])->name('marks.show');
    Route::post('/marks', [MarkController::class, 'store'])->name('marks.store');
    Route::put('/marks/{studentId}', [MarkController::class, 'update'])->name('marks.update');
    Route::delete('/marks/{studentId}', [MarkController::class, 'destroy'])->name('marks.destroy');
});




// Prediction Routes - All Authenticated Users
Route::middleware(['auth'])->group(function () {
    Route::post('/predictions/{studentId}', [PredictionController::class, 'predictMarks'])->name('predictions.predict');
});


Route::get('/teacher/evaluation', [TeacherController::class, 'evaluation'])->name('teacher.evaluation');






// Teacher subject Purpose

Route::middleware(['auth', 'role:teacher'])->group(function () {
    Route::get('/teacher/evaluation', [TeacherController::class, 'evaluation'])->name('teacher.evaluation');
    Route::get('/teacher/evaluation/subject/{subjectId}', [TeacherController::class, 'showStudents'])->name('teacher.showStudents');
    Route::get('/teacher/evaluation/student/{studentId}/marks', [TeacherController::class, 'viewStudentMarks'])->name('teacher.viewStudentMarks');
    Route::get('/marks/{id}/edit', [MarkController::class, 'edit'])->name('marks.edit');
});

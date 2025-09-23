<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentGroupController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherGroupController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout'])->name('logout');

// Teacher
Route::middleware(['auth:sanctum', 'role:staff'])->group(function () {
    Route::put('/teacher-update', [StaffController::class, 'update']);
    Route::get('/teacher-groups', [TeacherGroupController::class, 'show']);
    Route::get('/teacher-lessons', [TeacherGroupController::class, 'lessons']);
});

// Admin
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::resource('subjects', SubjectController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('groups', GroupController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('lessons', LessonController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('students', StudentController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);

    Route::put('/staffs/{id}/role', [StaffController::class, 'updateRole']);
    Route::resource('staffs', StaffController::class, ['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    
    Route::get('/student-groups', [StudentGroupController::class, 'index']);
    Route::get('/student-groups/{id}', [StudentGroupController::class, 'lessons']);
    Route::get('/student-groups/{id}/lessons', [StudentGroupController::class, 'lessons']);
    Route::post('/student-groups/{id}', [StudentGroupController::class, 'addStudent']);
    Route::delete('/student-groups/{id}', [StudentGroupController::class, 'deleteStudent']);

    Route::get('/teacher-groups', [TeacherGroupController::class, 'index']);
    Route::post('/teacher-groups/{id}', [TeacherGroupController::class, 'addTeacher']);
    Route::delete('/teacher-groups/{id}', [TeacherGroupController::class, 'deleteTeacher']);
});

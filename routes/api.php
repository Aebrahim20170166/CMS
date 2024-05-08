<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\RegisterationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::post('user/enroll', [EnrollmentController::class, 'enroll']);
    Route::post('instructor/join', [EnrollmentController::class, 'joinCourse']);
    Route::post('students/enrolled', [EnrollmentController::class, 'getAllEnrollments']);
    Route::post('user/update', [UserController::class, 'update']);
    Route::post('user/logout', [RegisterationController::class, 'logout']);

    Route::post('grade/assign', [GradeController::class, 'store']);
    Route::get('assignment/grade/all', [GradeController::class, 'index']);
    Route::get('grade/show/{grade}', [GradeController::class, 'show']);
    Route::patch('grade/update/{grade}', [GradeController::class, 'update']);
    Route::delete('grade/delete/{grade}', [GradeController::class, 'destroy']);

    Route::post('assignment/store', [AssignmentController::class, 'store']);
    Route::get('assignment/all', [AssignmentController::class, 'index']);
    Route::get('assignment/show/{assignment}', [AssignmentController::class, 'show']);
    Route::patch('assignment/update/{assignment}', [AssignmentController::class, 'update']);
    Route::delete('assignment/delete/{assignment}', [AssignmentController::class, 'destroy']);
});

Route::post('role/store', [RoleController::class, 'store']);
Route::get('role/all', [RoleController::class, 'index']);
Route::get('role/show/{role}', [RoleController::class, 'show']);
Route::patch('role/update/{role}', [RoleController::class, 'update']);
Route::delete('role/delete/{role}', [RoleController::class, 'destroy']);

Route::post('course/store', [CourseController::class, 'store']);
Route::get('course/all', [CourseController::class, 'index']);
Route::get('course/show/{course}', [CourseController::class, 'show']);
Route::patch('course/update/{course}', [CourseController::class, 'update']);
Route::delete('course/delete/{course}', [CourseController::class, 'destroy']);

Route::post('user/signup', [RegisterationController::class, 'signup']);
Route::post('user/login', [RegisterationController::class, 'login']);
Route::post('student/delete/user', [UserController::class, 'delete']);
Route::get('student/all', [UserController::class, 'allStudents']);
Route::get('instructor/all', [UserController::class, 'allInstructors']);


// Route::get('user/all', [StudentController::class, 'index']);
// Route::get('user/show/{student}', [StudentController::class, 'show']);
// Route::patch('user/update/{user}', [StudentController::class, 'update']);
// Route::delete('user/delete/{user}', [StudentController::class, 'destroy']);

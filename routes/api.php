<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Api\ClassController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('students', [StudentController::class, 'store']);
Route::get('students/{id}', [StudentController::class, 'show']);



Route::get('fetchClasses', [ClassController::class, 'fetchClasses']);


Route::post('registerStudent', [ApiController::class, 'registerStudent']);
Route::post('loginStudent', [ApiController::class, 'loginStudent']);

Route::post('registerTeacher', [TeacherController::class, 'registerTeacher']);
Route::post('loginTeacher', [TeacherController::class, 'loginTeacher']);
Route::get('fetchStudents', [ApiController::class, 'fetchStudents']);
Route::delete('deleteStudent/{id}/delete', [ApiController::class, 'deleteStudent']);
Route::put('updatestudents/{id}/edit', [ApiController::class, 'updatestudents']);

Route::post('addClass', [ClassController::class, 'addClass']);

Route::get('editClass', [ClassController::class, 'editClass']);

Route::get('fetchClasses', [ClassController::class, 'fetchClasses']);

Route::delete('deleteclasses/{id}/delete', [ClassController::class, 'deleteclasses']);

Route::delete('deleteteachers/{id}/delete', [TeacherController::class, 'deleteteachers']);

Route::get('fetchTeachers', [TeacherController::class, 'fetchTeachers']);









Route::group([
    "middleware" => ["auth:api"]
], function(){
    Route::get('profile', [ApiController::class, 'profile']);
    Route::get('refresh', [ApiController::class, 'refreshToken']);
    Route::get('logout', [ApiController::class, 'logout']);



    Route::get('editstudents/{id}/edit', [ApiController::class, 'editstudents']);



Route::get('editteachers/{id}/edit', [TeacherController::class, 'editteachers']);
Route::put('updateteachers/{id}/edit', [TeacherController::class, 'updateteachers']);


Route::put('updateclasses/{id}/edit', [ClassController::class, 'updateclasses']);







}
);








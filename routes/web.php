<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use \App\Http\Controllers\Dashboard,
    \App\Http\Controllers\CoursesController,
    \App\Http\Controllers\Student\ExerciseController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    Route::get('/courses/{id}', [CoursesController::class, 'index'])
        ->name('courses.index');

    Route::get('/courses/topic/{id}', [CoursesController::class, 'topic'])
        ->name('courses.topic');

    Route::get('/courses/topic/activities/{id}', [CoursesController::class, 'topicActivities'])
        ->name('courses.topic.activities');

    Route::get('/courses/usersByActivity/{id}', [CoursesController::class, 'usersByActivity'])
        ->name('courses.userByActivity');

    Route::post('/courses/saveActivity', [CoursesController::class, 'saveActivity'])
        ->name('courses.saveActivity');


    Route::get('/course/topic/gradebook/{id}', [CoursesController::class, 'topicGradebook'])
        ->name('courses.topicGradebook');

    Route::get('/student/exercise/questions/{id}', [ExerciseController::class, 'getQuestion']);

    Route::post('/student/exercise', \App\Http\Controllers\GradeExerciseController::class);
});

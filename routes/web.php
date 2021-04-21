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

    Route::get('/gradebook', \App\Http\Controllers\StudentGradebook::class);

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

    Route::post('/courses/saveStudentHomework/{id}', [CoursesController::class, 'saveStudentHomework']);
    Route::get('/courses/studentHomework/{id}', [CoursesController::class, 'studentHomework']);
    Route::get('/courses/studentDeleteHomework/{id}', [CoursesController::class, 'studentDeleteHomework']);


    Route::get('/course/topic/gradebookPdf/{id}', [CoursesController::class, 'topicGradebookPdf'])
        ->name('courses.topicGradebookPdf');

    Route::get('/course/topic/gradebookExcel/{id}', [CoursesController::class, 'topicGradebookExcel'])
        ->name('courses.topicGradebookExcel');

    Route::get('/student/exercise/questions/{id}', [ExerciseController::class, 'getQuestion']);

    Route::post('/student/exercise', \App\Http\Controllers\GradeExerciseController::class);

    // System Comments
    Route::get('/commnets/activity/{id}/{type}', [\App\Http\Controllers\CommentController::class, 'list']);
    Route::get('/commnets/answers/{id}', [\App\Http\Controllers\CommentController::class, 'answers']);

    Route::post('/commnets/activity/{type}', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::post('/commnets/storeAnswer/{type}', [\App\Http\Controllers\CommentController::class, 'storeAnswer']);

    Route::post('/comments/delete', [\App\Http\Controllers\CommentController::class, 'delete']);
});


Route::get('/gradebook/api', \App\Http\Controllers\GradebookController::class);

Route::get('/test', function (\App\Repositories\UserRepositoryInterface $userRepository) {
    $user = auth()->user();

    $user->notify(new \App\Notifications\StudentAlert([
        'title' => 'Hola Camaron sin cola'
    ]));
});

Route::get('/courseGradebook/{id}', function ($id) {
    $topic = \App\Models\Topic::find($id);
    $course = $topic->course;

    $gradebook = \Illuminate\Support\Facades\DB::table('activities')
        ->select('activities.name',
            'activities.score',
            'activities.end',
            'activity_user.score as result',
            'activity_user.comment'
        )
        ->leftJoin('activity_user', 'activity_user.activity_id', '=', 'activities.id')
        ->where('activities.topic_id', $id)
        ->where('activity_user.user_id', auth()->user()->id)
        ->get();

    $totalScore = $gradebook->sum('score');
    $totalScore = $totalScore > 100 ? 100 :  $totalScore;

    $totalResult = $gradebook->sum('result');
    $totalResult = $totalResult > 100 ? 100 : $totalResult;


    ##return ($gradebook);
    return \Inertia\Inertia::render('CourseGradebook')
        ->with(compact('course', 'topic', 'gradebook', 'totalScore', 'totalResult'));
});

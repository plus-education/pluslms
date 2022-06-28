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

use \App\Http\Controllers\CourseGradebookController;

use App\Http\Controllers\Auth\SocialiteController;

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/callback/google', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/microsoft', [SocialiteController::class, 'redirectToMicrosoft'])->name('microsoft.login');
Route::get('/callback/microsoft', [SocialiteController::class, 'handleMicrosoftCallback'])->name('microsoft.callback');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/logo', function () {
    return response([
        'url' => \Illuminate\Support\Facades\URL::asset( 'storage/'. nova_get_setting('logo_frontend'))
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function() {
    Route::get('/dashboard', Dashboard::class)
        ->name('dashboard');

    //Route::get('/gradebook', \App\Http\Controllers\StudentGradebook::class);

    Route::get('/courses/{id}', [CoursesController::class, 'index'])
        ->name('courses.index');

    Route::get('/courses/topic/{id}/{activity_id?}', [CoursesController::class, 'topic'])
        ->name('courses.topic');

    /*Route::get('/courses/topic/activities/{id}', [CoursesController::class, 'topicActivities'])
        ->name('courses.topic.activities');

    Route::get('/courses/usersByActivity/{id}', [CoursesController::class, 'usersByActivity'])
        ->name('courses.userByActivity');

    Route::post('/courses/saveActivity', [CoursesController::class, 'saveActivity'])
        ->name('courses.saveActivity');
    */
    /*
    Route::post('/courses/saveStudentHomework/{id}', [CoursesController::class, 'saveStudentHomework']);
    Route::get('/courses/studentHomework/{id}', [CoursesController::class, 'studentHomework']);
    Route::get('/courses/studentDeleteHomework/{id}', [CoursesController::class, 'studentDeleteHomework']);

    Route::get('/course/topic/gradebookPdf/{id}', [CoursesController::class, 'topicGradebookPdf'])
        ->name('courses.topicGradebookPdf');

    Route::get('/course/topic/gradebookExcel/{id}', [CoursesController::class, 'topicGradebookExcel'])
        ->name('courses.topicGradebookExcel');
    */

    /*Route::get('/student/exercise/questions/{id}', [ExerciseController::class, 'getQuestion']);

    Route::post('/student/exercise', \App\Http\Controllers\GradeExerciseController::class);
    Route::get('/student/exercise/score/{activityId}', function($id){
        $activityScore = \App\Models\ActivityUser::where('activity_id', $id)
            ->where('user_id', auth()->user()->id)
            ->get()
            ->first();

        if ($activityScore) {
            return response()->json([
                'hasScore' => true,
                'activityScore' => $activityScore
            ]);
        }

        return response()->json(['hasScore' => false]);
    });
    */

    // System Comments
    Route::get('/comments/activity/{id}/{type}', [\App\Http\Controllers\CommentController::class, 'list'])
        ->name('comments.activity');
    Route::get('/comments/answers/{id}', [\App\Http\Controllers\CommentController::class, 'answers'])
        ->name('comments.answers');

    Route::post('/comments/activity/{type}', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::post('/comments/storeAnswer/{type}', [\App\Http\Controllers\CommentController::class, 'storeAnswer']);

    Route::post('/comments/delete', [\App\Http\Controllers\CommentController::class, 'delete']);

    // Get previous and next navigation for the activity, if it applies
    Route::get('/nav/topic/activity/{id}', function ($id) {
        return \App\Models\Activity::find($id)?->prev_next_ids;
    })->name('nav.topic.activity');
});

Route::get('/notifications', function () {
    return auth()->user()->notifications;
});

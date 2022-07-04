<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

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
    \App\Http\Controllers\AccessCodeController,
    \App\Http\Controllers\CoursesController,
    \App\Http\Controllers\Student\ExerciseController;

use \App\Http\Controllers\CourseGradebookController;

use App\Http\Controllers\Auth\SocialiteController;

Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/callback/google', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/microsoft', [SocialiteController::class, 'redirectToMicrosoft'])->name('microsoft.login');
Route::get('/callback/microsoft', [SocialiteController::class, 'handleMicrosoftCallback'])->name('microsoft.callback');

Route::get('/', function () {
    return Inertia::render('Index');
})->name('index');

Route::get('/logo', function () {
    if (file_exists(storage_path('app/public/' . nova_get_setting('logo_frontend')))) {
        return null;
    }

    return response([
        'url' => \Illuminate\Support\Facades\URL::asset( 'storage/'. nova_get_setting('logo_frontend'))
    ]);
})->name('logo');

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

    Route::post('/access-code', [AccessCodeController::class, 'addToCourse'])->name('access-code');
});

Route::get('/notifications', function () {
    return auth()->user()->notifications;
});

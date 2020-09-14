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

Route::get('/', function () {
    return Inertia\Inertia::render('home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

    $courses = auth()->user()->courses->map(function ($course) {
        return [
            'id' => $course->id,
            'name' => $course->name,
            'code' => $course->code,
            'description' => $course->description,
            'group' => $course->group->name
        ];
    });



    return Inertia\Inertia::render('Dashboard')->with(compact('courses'));

})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/courses/{id}', function ($id) {

    $course = \App\Models\Course::find($id)->with('group', 'topics')->first();
    return Inertia\Inertia::render('Course/Index')
        ->with(compact('course'));

})->name('courses.index');

Route::middleware(['auth:sanctum', 'verified'])->get('/courses/topic/{id}', function ($id) {
        $topic = \App\Models\Topic::find($id);
        $topic->course;
        $topic->activities;

        return Inertia\Inertia::render('Course/Topic')
            ->with(compact('topic'));
})->name('courses.topic');

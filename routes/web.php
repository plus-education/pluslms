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

Route::get('/logo', function () {
    return response([
        'url' => \Illuminate\Support\Facades\URL::asset( 'storage/'. nova_get_setting('logo_frontend'))
    ]);
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

    Route::get('/groupGradebook/{id}', [\App\Http\Controllers\GroupGradebookController::class, 'index']);

    Route::get('/groupGradebook/gradebook/{group}/{student}', [\App\Http\Controllers\GroupGradebookController::class, 'gradebook']);

    Route::get('/student/myCalendar', function () {
        return \Inertia\Inertia::render('MyCalendar');
    });

    Route::get('/student/myActivities', function () {
        $user = auth()->user();
        $myCourses = $user->courses->pluck('id')->toArray();

        $activities = \Illuminate\Support\Facades\DB::table('activities')
            ->select('activities.name', 'activities.name', 'activities.score', 'activities.start', 'activities.end', 'topics.id as topic_id', 'topics.name as topic', 'courses.id as course_id',  'courses.name as course')
            ->leftJoin('topics', 'activities.topic_id', 'topics.id')
            ->leftJoin('courses', 'topics.course_id', 'courses.id')
            ->where('activities.score', '>', 0)
            ->where('activities.start', '<>', 'null')
            ->where('activities.end', '<>', 'null')
            ->whereIn('courses.id', $myCourses)
            ->get();

        return $activities->map(function ($activity){
            return [
                'title' => "<a href='/courses/topic/{$activity->topic_id}' target='_blank'>{$activity->name} {$activity->score} pts </a>",
                'start' => $activity->end,
                'end' => $activity->end,
                'content' => "<a href='/courses/topic/{$activity->topic_id}' target='_blank'>{$activity->course}</a>",
                'class' => "event-" . rand(1,10)
            ];
        });
    });
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
        ->select('activities.id',
            'activities.name',
            'activities.score',
            'activities.end',
        )
        ->where('score', '>', 0)
        ->where('activities.topic_id', $id)
        ->get();

    $user = auth()->user();

    $gradebook = $gradebook->map(function ($activity) use ($user) {
        $homework = \Illuminate\Support\Facades\DB::table('activity_user')
            ->where('activity_id', $activity->id)
            ->where('user_id', $user->id)
            ->first();

        if ($homework) {
            $activity->result = $homework->score;
            $activity->comment = $homework->comment;
        }

        return $activity;
    });


    $totalScore = $gradebook->sum('score');
    $totalScore = $totalScore > 100 ? 100 :  $totalScore;

    $totalResult = $gradebook->sum('result');
    $totalResult = $totalResult > 100 ? 100 : $totalResult;


    ##return ($gradebook);
    return \Inertia\Inertia::render('CourseGradebook')
        ->with(compact('course', 'topic', 'gradebook', 'totalScore', 'totalResult'));
});

Route::get('/topicGradebook/{id}', function($id) {
    $topic = App\Models\Topic::find($id);
    return \Inertia\Inertia::render('Admin/TopicGradebook', [
        'group' => $topic->course->group,
        'topic' => $topic,
        'students' => $topic->course->students->map(function ($student) use($topic) {
            $student->scores =  DB::table('activity_user')
                ->leftJoin('activities', 'activity_user.activity_id', 'activities.id')
                ->where('activity_user.user_id', $student->id)
                ->where('activities.topic_id', $topic->id)
                ->select('activity_user.*')
                ->get()
                ->keyBy('activity_id');

            $student->total = $student->scores->sum('score');
            return $student;
        }),
        'activities' => $topic->activities->where('score', '>', 0)
    ]);
});

Route::post('/topicGradebook/update/{topicId}/{userId}', function (\Illuminate\Http\Request $request, $topicId, $userId){
    $student = \App\Models\User::find($userId);
    $score = $student->activities()->updateExistingPivot($request->post('activity_id'),  [
        'score' =>  $request->post('score'),
    ]);

    $scores =  DB::table('activity_user')
        ->leftJoin('activities', 'activity_user.activity_id', 'activities.id')
        ->where('activity_user.user_id', $student->id)
        ->where('activities.topic_id', $topicId)
        ->select('activity_user.*')
        ->get();

    $student->total = $scores->sum('score');
    return $student;
});

Route::post('/topicGradebook/save/{userId}/{activityId}', function (\Illuminate\Http\Request $request, $userId, $activityId) {
    $student = \App\Models\User::find($userId);
    $score = $student->activities->where('id', $activityId)->first();

    if ($score) {
        $newScore = $student->activities()->updateExistingPivot($activityId,  [
            'score' =>  $request->post('score'),
        ]);
    }else {
        $newScore = $student->activities()->attach($activityId,  [
            'comment' =>  '',
            'score' => $request->post('score'),
            'file' => null
        ]);
    }

    $student->scores =  DB::table('activity_user')
        ->leftJoin('activities', 'activity_user.activity_id', 'activities.id')
        ->where('activity_user.user_id', $student->id)
        ->where('activities.topic_id', $request->post('topicId'))
        ->select('activity_user.*')
        ->get();

    $student->newScore = $newScore;
    $student->total = $student->scores->sum('score');
    return $student;
});

Route::get('/notifications', function () {
    return auth()->user()->notifications;
});

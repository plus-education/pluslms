<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Inertia\Inertia;

use App\Models\Topic;
use App\Models\Activity;

class CourseGradebookController extends Controller
{
    public function __invoke()
    {

    }

    public function show($id) {
        $topic = Topic::find($id);
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


        return Inertia::render('CourseGradebook')
            ->with(compact('course', 'topic', 'gradebook', 'totalScore', 'totalResult'));
    }
}

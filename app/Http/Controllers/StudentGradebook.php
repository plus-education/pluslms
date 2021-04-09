<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class StudentGradebook extends Controller
{
    public function __invoke()
    {
        $user = auth()->user();

        $gradebook = \DB::table('activity_user')
            ->select(
                'courses.name',
                'topics.name as topic',
                DB::raw('sum(activity_user.score) as total')
            )
            ->leftJoin('activities', 'activity_user.activity_id', '=', 'activities.id')
            ->leftJoin('topics', 'activities.topic_id', '=', 'topics.id')
            ->leftJoin('courses', 'topics.course_id', '=', 'courses.id')
            ->where('activity_user.user_id', $user->id)
            ->where('topics.name', 'Bimestre 1')
            ->groupBy('courses.id')
            ->groupBy('topics.id')
            ->get();


        $comments = \DB::table('topic_user')
            ->select('courses.name', 'topic_user.comment')
            ->leftJoin('topics', 'topic_user.topic_id', '=', 'topics.id')
            ->leftJoin('courses', 'topics.course_id', '=', 'courses.id')
            ->where('topic_user.user_id', $user->id)
            ->get();

        return Inertia::render('Gradebook')
            ->with(compact('gradebook', 'comments'));
    }
}

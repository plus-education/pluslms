<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index($id)
    {
        $course = Course::where('id', $id)->with('group', 'topics')->first();

        return Inertia::render('Course/Index')
            ->with(compact('course'));
    }

    public function topic($id)
    {
        $topic = Topic::find($id);
        $topic->course;
        $topic->activities;
        return Inertia::render('Course/Topic')
            ->with(compact('topic'));
    }

    public function usersByActivity($id)
    {
        return Activity::findOrFail($id)->topic->course->students->map(function ($student) use($id) {
            $activity =   ($student->activities->where('id', $id)->first()) ? $student->activities->where('id', $id)->first()->pivot : [ 'comment' => '' ,'score' => 0 ];
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'profile_photo_url' => $student->profile_photo_url,
                'activity' => $activity
            ];
        });
    }

    public function saveActivity(Request $request)
    {
        $student = User::find($request->post('student_id'));
        $activity = Activity::find($request->post('activity_id'));

        $score = $student->activities->where('id', $activity->id)->first();
        if ($score) {
            return $student->activities()->updateExistingPivot($activity->id,  [
                'comment' =>  $request->post('comment'),
                'score' => $request->post('score')
            ]);
        }

        return $student->activities()->attach($activity->id,  [
            'comment' =>  $request->post('comment'),
            'score' => $request->post('score')
        ]);
    }

    public function topicGradebook($id)
    {
        $topic = Topic::find($id);
        $students = $topic->course->students;
        $activities = $topic->activities->where('score', '>', 0);

        $pdf = \PDF::loadView('topicGradebook', compact('topic', 'students', 'activities'));
        $pdf->setPaper('legal', 'landscape');

        return $pdf->download('gradebook.pdf');
        #return view('topicGradebook')->with(compact('topic', 'students', 'activities'));
    }
}

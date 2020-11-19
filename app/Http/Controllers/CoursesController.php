<?php

namespace App\Http\Controllers;

use App\Exports\CourseGradebookExport;
use App\Models\Activity;
use App\Models\Course;
use App\Models\Topic;
use App\Models\TypesActivities\Divider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

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
        $topic->activities;
        $topic->course;

        return Inertia::render('Course/Topic')
            ->with(compact('topic'));
    }

    public function topicActivities($id)
    {
        return Topic::find($id)->activities;
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

    public function topicGradebookPdf($id)
    {
        $topic = Topic::find($id);
        $students = $topic->course->students;
        $activities = $topic->activities->where('score', '>', 0);

        $pdf = \PDF::loadView('exports.pdf.topicGradebook', compact('topic', 'students', 'activities'));
        $pdf->setPaper('legal', 'landscape');

        return $pdf->download('gradebook.pdf');
        //return view('exports.topicGradebook')->with(compact('topic', 'students', 'activities'));
    }

    public function topicGradebookExcel($id)
    {
        return Excel::download(new CourseGradebookExport($id), __('Gradebook') . '.xlsx');
    }
}

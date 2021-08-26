<?php

namespace App\Http\Controllers\Gradebook;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\ActivityUser;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class CourseGradebookByAllActivitiesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Course $course)
    {
        $activities = DB::table('activities')
            ->leftJoin('topics', 'activities.topic_id', '=', 'topics.id')
            ->leftJoin('courses', 'topics.course_id', '=', 'courses.id')
            ->where('courses.id', '=', $course->id)
            ->where('activities.score', '>', 0)
            ->select('activities.id', 'activities.name', 'activities.score')
            ->get();

        $activities = Activity::whereHas('topic', function($query) use ($course) {
            return $query->where('course_id', '=', $course->id)
                ->where('score', '>', 0);
        })
            ->get();



        //return view('gradebook.all_activities_by_course')->with(compact('course', 'activities'));

        $pdf = \PDF::loadView('gradebook.all_activities_by_course', compact('course', 'activities'));
        $pdf->setPaper('legal', 'landscape');

        return $pdf->download('gradebook.pdf');
    }

    private function getStudentWithActivityScore($students, $activities)
    {
        return $students->map(function($student) use ($activities) {
            $student->activities = $activities->map(function ($activity) use ($student){
                if($activity->studentScore($student)) {
                    $score = $activity->studentScore($student)->pivot;
                    $activity->studentScore = $score;
                }


                return $activity;
            });
            return $student;
        });
    }
}

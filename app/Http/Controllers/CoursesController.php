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
        $activities = $topic->activities->where('isShow', true);
        $topic->course;

        return Inertia::render('Course/Topic')
            ->with(compact('topic', 'activities'));
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
                'activity' => $activity,
                'homework' => $this->getStudentHomework($student, $id)
            ];
        });
    }

    private function getStudentHomework(User $student, $activityId)
    {
        $studentActivities = $student->activities->where('id', $activityId)->first();

        if ($studentActivities) {
           return $studentActivities->pivot->file;
        }

        return false;
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

    public function saveStudentHomework(Request $request, $activity_id)
    {
        if(!$request->file('file')) {
            return false;
        }

        $activity = Activity::find($activity_id);

        $path = $request->file('file')->store('homework');

        $score = auth()->user()->activities->where('id', $activity->id)->first();

        if ($score) {
            auth()->user()->activities()->updateExistingPivot($activity->id,  [
                'file' =>  $path,
            ]);

            return json_encode(['status'=> true, 'file' => $path]);
        }

        auth()->user()->activities()->attach($activity->id,  [
            'comment' =>  '',
            'score' => 0,
            'file' => $path
        ]);

        return json_encode(['status'=> true, 'file' => $path]);

    }


    public function studentHomework($activityId)
    {
        if(!auth()->user()->activities->where('id', $activityId)->first()) {
            return json_encode(['status'=> false]);

        }

        $file = auth()->user()->activities->where('id', $activityId)->first()->pivot->file;

        if ($file == ''){
            return json_encode(['status'=> false]);
        }

        return json_encode(['status'=> true, 'file' => $file]);
    }

    public function studentDeleteHomework($activityId)
    {
        return auth()->user()->activities()->updateExistingPivot($activityId,  [
            'file' =>  '',
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

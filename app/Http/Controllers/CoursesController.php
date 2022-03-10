<?php

namespace App\Http\Controllers;

use App\Exports\CourseGradebookExport;
use App\Models\Activity;
use App\Models\Course;
use App\Models\GradebookRow;
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
        $course = Course::where('id', $id)
            ->with('group', 'topics')
            ->first();

        return Inertia::render('Course/Index')
            ->with(compact('course'));
    }


    public function topicHome($id)
    {
        $topic = Topic::with('course')->where('id', $id)->first();

        return Inertia::render('Course/TopicHome')
            ->with(compact('topic'));
    }

    public function topic($id)
    {
        $topic = Topic::find($id);
        $activities = $topic->activities->where('isShow', true);
        $activities = $activities->filter(function ($activity){
            if($activity->isActiveToDo) {
                return $activity;
            }
        });
        $topic->course;

        return Inertia::render('Course/Topic')
            ->with(compact('topic', 'activities'));
    }

    public function topicActivities($id)
    {
        return Topic::find($id)->activities->where('isShow', true);
    }

    public function usersByActivity($id)
    {
        return GradebookRow::findOrFail($id)->topic->course->students->map(function ($student) use($id) {
            $activity =   ($student->gradebookRow->where('id', $id)->first()) ? $student->gradebookRow->where('id', $id)->first()->pivot : [ 'comment' => '' ,'score' => 0 ];

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
        $studentActivities = $student->gradebookRow->where('id', $activityId)->first();

        if ($studentActivities) {
           return $studentActivities->pivot->file;
        }

        return false;
    }

    public function saveActivity(Request $request)
    {
        $student = User::find($request->post('student_id'));
        $activity = Activity::find($request->post('activity_id'));
        dd($activity);
        $score = $student->gradebookRow->where('id', $activity->id)->first();
        if ($score) {
            return $student->gradebookRow()->updateExistingPivot($activity->id,  [
                'comment' =>  $request->post('comment'),
                'score' => $request->post('score')
            ]);
        }

        return $student->gradebookRow()->attach($activity->id,  [
            'comment' =>  $request->post('comment'),
            'score' => $request->post('score'),
            'created_at' => null
        ]);
    }

    public function saveStudentHomework(Request $request, $activity_id)
    {
        if(!$request->file('file')) {
            return false;
        }

        $activity = GradebookRow::find($activity_id);

        $path = $request->file('file')->store('homework');

        $score = auth()->user()->gradebookRow->where('id', $activity->id)->first();

        if ($score) {
            auth()->user()->gradebookRow()->updateExistingPivot($activity->id,  [
                'file' =>  $path,
            ]);

            return json_encode(['status'=> true, 'file' => $path]);
        }

        $return = auth()->user()->gradebookRow()->attach($activity->id,  [
            'comment' =>  '',
            'score' => 0,
            'file' => $path
        ]);
    }


    public function studentHomework($activityId)
    {
        if(!auth()->user()->gradebookRow->where('id', $activityId)->first()) {
            return json_encode(['status'=> false]);

        }

        $gradebookRow = auth()->user()->gradebookRow->where('id', $activityId)->first();
        $file = $gradebookRow->pivot->file;

        if ($file == ''){
            return json_encode([
                'status' => false,
                'score'=> $gradebookRow->pivot->score,
                'comment' => $gradebookRow->pivot->comment
            ]);
        }

        return json_encode([
            'status'=> true,
            'file' => $file,
            'score' => $gradebookRow->pivot->score,
            'comment' => $gradebookRow->pivot->comment
        ]);
    }

    public function studentDeleteHomework($activityId)
    {
        return auth()->user()->gradebookRow()->updateExistingPivot($activityId,  [
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
        return view('exports.topicGradebook')->with(compact('topic', 'students', 'activities'));
    }

    public function topicGradebookExcel($id)
    {
        return Excel::download(new CourseGradebookExport($id), __('Gradebook') . '.xlsx');
    }
}

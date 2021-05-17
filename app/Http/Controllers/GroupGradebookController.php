<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GroupGradebookController extends Controller
{
    private $gradebook;

    private $student;

    public function index($id)
    {
        $group = Group::find($id);
        $students = $group->students;

        return Inertia::render('Admin/ListStudentGroup')
            ->with(compact('group', 'students'));
    }

    public function gradebook($group, $user)
    {
            $this->student = User::find($user);

            $group = Group::find($group);

            $group->courses->each(function ($course) {
                $this->courseGradebook($course);
            });

            $this->gradebook['student'] = $this->student;
            $this->gradebook['group'] = $group;
            $gradebook = $this->gradebook;
            return Inertia::render('Admin/GroupGradebook')
                ->with(compact('gradebook'));
            //$this->gradebook->student = $this->student;
            return response($this->gradebook);
    }

    private function courseGradebook($course)
    {
        $this->gradebook['courses'][$course->id]['id'] = $course->id;
        $this->gradebook['courses'][$course->id]['name'] = $course->name;
        $this->gradebook['courses'][$course->id]['modules'] = $course->topics->map(function ($topic){
            $topic->activities = DB::table('activities')
                ->select('id', 'name', 'score')
                ->where('topic_id', $topic->id)
                ->get();

            $topic->activities = $this->addStudentActivityScore($topic->activities);
            $topic->totalScore = $topic->activities->sum('score');
            $topic->totalStudentScore = $topic->activities->sum('studentScore');
            return $topic;
        });
    }

    private function addStudentActivityScore($activities)
    {
        return $activities->map(function ($activity) {
                $studentScore= \Illuminate\Support\Facades\DB::table('activity_user')
                ->where('activity_id', $activity->id)
                ->where('user_id', $this->student->id)
                ->first();

            $activity->studentScore = ($studentScore == null) ? 0 : $studentScore->score;
           # $activity->studentScore = $studentScore;

            return $activity;
        });
    }
}

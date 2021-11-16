<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CourseGradebookWhithAllActivitiesExport implements FromView
{
    private $course;

    private $activities;

    public function __construct($course, $activities)
    {
        $this->course = $course;
        $this->activities = $activities;
    }

    public function  view(): View
    {
        $course = $this->course;
        $activities = $this->activities;

        return view('gradebook.all_activities_by_course',
            compact('course', 'activities'));
    }
}

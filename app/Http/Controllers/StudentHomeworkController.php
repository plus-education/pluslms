<?php

namespace App\Http\Controllers;

use App\Models\GradebookRow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentHomeworkController extends Controller
{
    public function __invoke($id)
    {
        $homework = GradebookRow::find($id);
        $topic = $homework->topic;
        $course = $topic->course;
        return Inertia::render('Course/StudentHomework')
            ->with(compact('homework', 'topic', 'course'));
    }
}

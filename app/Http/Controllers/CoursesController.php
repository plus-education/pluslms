<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Topic;
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
}

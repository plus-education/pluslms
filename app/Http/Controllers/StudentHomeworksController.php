<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\GradebookRow;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentHomeworksController extends Controller
{
    public function __invoke($id)
    {
        $topic = Topic::with('course')->where('id', $id)->first();

        $homeworks = GradebookRow::where('topic_id', $topic->id)
            ->orderBy('start')
            ->get();

        return Inertia::render('Course/Homeworks')
            ->with(compact('topic', 'homeworks'));
    }
}

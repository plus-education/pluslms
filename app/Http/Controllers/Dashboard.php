<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class Dashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $courses = auth()->user()->courses->map(function ($course) {
            return [
                'id' => $course->id,
                'name' => $course->name,
                'code' => $course->code,
                'description' => $course->description,
                'group' => $course->group->name,
                'coverPath' => $course->coverPath
            ];
        });

        $group = auth()->user()->groups()->first();

        return Inertia::render('Dashboard')->with(compact('courses', 'group'));
    }
}

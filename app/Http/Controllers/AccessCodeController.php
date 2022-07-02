<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AccessCode;
use App\Models\Course;

class AccessCodeController extends Controller
{
    public function addToCourse()
    {
        $code = AccessCode::where('code', request()->input('code'))
            ->get()
            ->first();

        if ($code === null) {
            return response([
                'msg' => "Code doesn't exist."
            ], 404)
                ->header('Content-Type', 'application/json');
        }

        $user = request()->user();
        $course = $code->course;
        if ($course === null) {
            return response([
                'msg' => "Couldn't find course."
            ], 404)
                ->header('Content-Type', 'application/json');
        }

        if ($user->courses->contains($course)) {
            return response([
                'msg' => "You're already in this course!"
            ], 400)
                ->header('Content-Type', 'application/json');
        }

        $user->courses()->save($course);
        return response([
            'msg' => "Added you to the course."
        ], 200)
            ->header('Content-Type', 'application/json');


    }
}

<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\TypesActivities\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function getQuestion($id)
    {
         return  Exercise::select()
         ->with(['questions' => function ($query)  use ($id) {
                return $query->with(['questionable' => function ($query) {
                    return $query->with('questionOptions');
                }]);
            }])
             ->where('id', $id)
             ->first();
    }
}

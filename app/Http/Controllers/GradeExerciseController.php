<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeExerciseController extends Controller
{
    public function __invoke(Request $request)
    {
        $exercise = $request->get('exercice');

        $totalScore = 0;
        foreach ($exercise['questions'] as $question) {
            if ($this->checkAnswer($question['questionable']) ) {
                $totalScore = $totalScore + $question['score'];
            }
        }
        auth()->user()->gradeExercise($request->get('activityId'), $totalScore);
        return ['totalScore' => $totalScore];
    }

    private function checkAnswer($answer)
    {
        $corectAnswer = 0;
        foreach ($answer['question_options'] as $option) {

            if($this->checkOptions($option)){
                $corectAnswer++;
            }else{
                $corectAnswer--;
            }
        }


        if($corectAnswer == 0 || $corectAnswer < 0) {
            return  0;
        }

        return (sizeof($answer['question_options']) / $corectAnswer == 1) ? true : false;
    }

    private function checkOptions($option) {
        if($option['isTrue'] ==  $option['isChecked']) {
            return true;
        }

        return false;
    }
}

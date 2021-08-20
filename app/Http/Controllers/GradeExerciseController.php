<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GradeExerciseController extends Controller
{
    public function __invoke(Request $request)
    {
        $exercise = $request->get('exercice');

        $totalScore = 0;



        foreach ($exercise['questions'] as $question) {
            if (!is_null($question['options'])){
                $totalScore += $this->checkAnswer($question);
            }else{
                if(array_key_exists('result', $question)) {
                    $totalScore += $question['result'];
                }
            }
        }

        $user = auth()->user();

        if(!$user->hasRole(Roles::STUDENT)){
            $user = User::findOrFail($request->get('studentId'));
        }

        $user->gradeExercise($request->get('activityId'), $totalScore, '', json_encode($exercise));

        return ['totalScore' => $totalScore];
    }

    private function checkAnswer($question)
    {
        $corectAnswer = 0;
        $incorrectAnswer = 0;
        foreach ($question['options'] as $option) {
            if($option['isCorrect']){
                $corectAnswer++;
            }else{
                $incorrectAnswer++;
            }
        }


        if($corectAnswer == 0 || $corectAnswer < 0) {
            return  0;
        }

        $scorebyOption = $question['score'] / sizeof($question['options']);
        return ($corectAnswer * $scorebyOption) - ($incorrectAnswer * $scorebyOption);
    }

    private function checkOptions($option) {
        if($option['isTrue'] ==  $option['isChecked']) {
            return true;
        }

        return false;
    }

    private function rateOpenAnswer() {

    }
}

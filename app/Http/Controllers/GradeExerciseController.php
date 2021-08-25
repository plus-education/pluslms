<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;

class GradeExerciseController extends Controller
{
    public function __invoke(Request $request)
    {
        $exercise = $request->get('exercice');

        $totalScore = 0;



        foreach ($exercise['questions'] as $key=>$question) {
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
            $option['isChecked'] = array_key_exists('isChecked', $option) ? $option['isChecked'] : false;
            if( ($option['isCorrect'] == $option['isChecked'])  ){
                $corectAnswer++;
            }else{
                $incorrectAnswer++;
            }
        }


        if($corectAnswer == 0 || $corectAnswer < 0) {
            return  0;
        }
        $scorebyOption = $question['score'] / sizeof($question['options']);
        $result = ($corectAnswer * $scorebyOption) - ($incorrectAnswer * $scorebyOption);
        dd($scorebyOption, $corectAnswer, $incorrectAnswer, $result, $question);
        return $result;
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

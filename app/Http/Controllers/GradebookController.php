<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Roles;
use App\Models\TypesActivities\Text;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradebookController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $users = User::all()->each(function ($user){
            if ($user->hasRole(Roles::STUDENT)) {
                $gradebook = $this->totalScore($user);
                $this->makeScore($gradebook, $user);
            }
        });

        return  'XD';
    }

    private function totalScore($user)
    {
        return \DB::table('activity_user')
            ->select(
                'course_id as course_id',
                'courses.name',
                'topics.name as topic',
                'topics.id as topic_id',
                DB::raw('sum(activity_user.score) as total')
            )
            ->leftJoin('activities', 'activity_user.activity_id', '=', 'activities.id')
            ->leftJoin('topics', 'activities.topic_id', '=', 'topics.id')
            ->leftJoin('courses', 'topics.course_id', '=', 'courses.id')
            ->where('activity_user.user_id', $user->id)
            ->where('topics.name', 'Bimestre 1')
            ->groupBy('courses.id')
            ->groupBy('topics.id')
            ->get();
    }

    private function makeScore($gradebook, $user)
    {
        $gradebook->each(function ($course) use ($user) {
            $this->makeActivity($course->topic_id, $user, $course->total);
        });
    }

    public function makeActivity($topic_id, $user, $total)
    {

        $text = new Text(['body' => 'Ajuste Nota Final']);
        $text->save();

        $activity = new Activity([
            'topic_id' => $topic_id,
            'name' => 'Ajuste Nota',
            'score' => 100,
            'activityable_id' => $text
        ]);


        $activity->save();

        $user->activities()->attach($activity->id,  [
            'comment' =>  'Ajuste Nota Final',
            'score' => $this->totalFixed($total)
        ]);
    }

    private function totalFixed($total)
    {
        if ($total < 40 ) {
            return rand(65, 70) - $total;
        }

        if ($total <  71) {
            return rand(70, 75) - $total;
        }

        return rand(5, 10);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupUser::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class)
            ->withPivot('score', 'comment', 'file');
    }

    public function gradeExercise($id, $score = 0, $comment = '')
    {
        $activity = Activity::find($id);
        $userActivity = $this->activities->where('id', $activity->id)->first();

        if ($userActivity) {
            return $this->activities()->updateExistingPivot($activity->id,  [
                'comment' => $comment,
                'score' => $score
            ]);
        }

        return $this->activities()->attach($activity->id,  [
            'comment' => $comment,
            'score' => $score
        ]);
    }

    public function activityScore($id)
    {
        $activityScore = $this->activities->where('id', $id)->first();
        return   ($activityScore) ?  $activityScore->pivot->score : false;
    }

    public function scoreTopic($id)
    {
        return DB::table('activity_user')
            ->select(DB::raw('sum(activity_user.score) as total'))
            ->leftJoin('activities', 'activity_user.activity_id', '=', 'activities.id')
            ->leftJoin('topics', 'activities.topic_id', '=', 'topics.id')
            ->where('topics.id', $this->id)
            ->where('activity_user.user_id', $this->id)
            ->first()->total;
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class)
            ->withPivot('comment');
    }
}

<?php

namespace App\Models;

use App\Models\Course;
use App\Models\TSChannel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Nova\Auth\Impersonatable;
use Spatie\Permission\Traits\HasRoles;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client;

use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Impersonatable;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use HasBelongsToManyEvents;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($model) {
            // Upon creation, assign student as the default role.
            $model->assignRole(Roles::STUDENT);
        });

        // Run some code when a model is attached to the user
        static::belongsToManyAttached(function ($relation, $parent, $ids) {
            // If the course has ThingSpeak channels, then add one for this user.
            $course = null;

            if ($relation === "courses") {
                $course = Course::find($ids[0]);
            }

            if ($course !== null && $course->has_ts_channels) {
                $channel = TSChannel::where([
                    'user_id' => $parent->id,
                    'course_id' => $course->id,
                ])->first();

                if ($channel === null) {
                    $res = null;

                    $client = new Client();
                    try {
                        $res = $client->post('https://api.thingspeak.com/channels.json', [
                            'form_params' => [
                                'api_key' => ENV('THINGSPEAK_API_KEY'),
                                'name' => "Course#{$course->id}:USER#{$parent->id}",
                                'public_flag' => true,
                            ]
                        ]);
                    } catch (ClientException $e) {}

                    if ($res !== null && $res->getStatusCode() === 200) {
                        $data = json_decode($res->getBody(), true);

                        $channel = TSChannel::create([
                            'channel_id' => $data['id'],
                            'api_key' => $data['api_keys'][0]['api_key'],
                            'user_id' => $parent->id,
                            'course_id' => $course->id,
                        ]);
                    }
                }
            }
        });

        // Run some code when a model is detached to the user
        static::belongsToManyDetaching(function ($relation, $parent, $ids) {
            // If the course has ThingSpeak channels, then add one for this user.
            $course = null;

            if ($relation === "courses") {
                $course = Course::find($ids[0]);
            }

            if ($course !== null && $course->has_ts_channels) {
                $channel = TSChannel::where([
                    'user_id' => $parent->id,
                    'course_id' => $course->id,
                ])->first();

                if ($channel !== null) {
                    $res = null;

                    $client = new Client();
                    try {
                        $res = $client->delete("https://api.thingspeak.com/channels/{$channel->channel_id}.json", [
                            'form_params' => [
                                'api_key' => ENV('THINGSPEAK_API_KEY'),
                            ]
                        ]);
                    } catch (ClientException $e) {}

                    if ($res !== null && $res->getStatusCode() === 200) {
                        $channel->delete();
                    }
                }
            }
        });
    }

    /**
     * Determine if the user can impersonate another user.
     *
     * @return bool
     */
    public function canImpersonate()
    {
        return $this->hasRole(Roles::SUPER_ADMIN);
    }

    /**
     * Determine if the user can be impersonated.
     *
     * @return bool
     */
    public function canBeImpersonated()
    {
        return !$this->hasRole(Roles::SUPER_ADMIN);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'social_id',
        'social_type',
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
        'is_solvent' => 'boolean'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
        'group'
    ];

    public function groups()
    {
        return $this->belongsToMany(Group::class)->using(GroupUser::class);
    }

    public function getGroupAttribute()
    {
        return $this->groups->first();
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function activities()
    {
        return $this->belongsToMany(Activity::class)
            ->withPivot('score', 'comment', 'file', 'created_at', 'updated_at', 'text');
    }

    public function gradeExercise($id, $score = 0, $comment = '', $exercise = '')
    {
        $activity = Activity::find($id);
        $userActivity = $this->activities->where('id', $activity->id)->first();

        if ($userActivity) {
            return $this->activities()->updateExistingPivot($activity->id,  [
                'comment' => $comment,
                'score' => $score,
                'text' => $exercise
            ]);
        }

        return $this->activities()->attach($activity->id,  [
            'comment' => $comment,
            'score' => $score,
            'text' => $exercise
        ]);
    }

    public function activityScore($id)
    {
        $score = DB::table('activity_user')
            ->select('activity_user.score')
            ->where('activity_id', $id)
            ->where('user_id', $this->id)
            ->value('score');
        return empty($score) ? 0.00 : $score;
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

    /*
     * @param Activty id $id
     */
    public function activityResult($id)
    {
    }

    public function ts_channels()
    {
        return $this->hasMany(TSChannel::class);
    }
}

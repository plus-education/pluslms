<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeeklyPlanning extends Model
{
    use HasFactory;

    use SoftDeletes;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'from' => 'datetime:d-m-y',
        'to' => 'datetime:d-m-y',
    ];


    protected $appends = ['course'];

    public function topic () {
        return $this->belongsTo(Topic::class);
    }

    public function dayPlannings()
    {
        return $this->hasMany(DayPlanning::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')
            ->whereNull('parent_id')
            ->orderBy('id', 'DESC');
    }

    public function getCourseAttribute()
    {
        return $this->topic->course;
    }
}

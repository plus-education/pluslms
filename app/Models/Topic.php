<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Topic extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $casts = [
        'startDate' => 'datetime:d-m-Y',
        'endDate' => 'datetime:d-m-Y',
    ];

    protected $appends = ['isShow'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)
            ->orderBy('order');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('comment');
    }

    public function  weeklyPlannings()
    {
        return $this->hasMany(WeeklyPlanning::class);
    }

    public function getTotalActivitiesAttribute()
    {
        return $this->activities()->sum('score');
    }

    public function getIsShowAttribute()
    {
        $today = Carbon::now();

        if ($this->startDate == null && $this->endDate == null) {
            return true;
        }

        if ($this->startDate != null && $this->endDate == null) {
            return $today->greaterThan($this->startDate);
        }

        if ($this->startDate == null && $this->endDate != null) {
            return $today->lessThanOrEqualTo($this->endDate);
        }

        return $today->between($this->startDate, $this->endDate);
    }
}

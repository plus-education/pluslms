<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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

    protected $appends = ['isShow', 'totalActivities'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function gradebookRows()
    {
        return $this->hasMany(GradebookRow::class)
            ->orderBy('start');
    }

    public function activities()
    {
        return $this->hasMany(Activity::class)
            ->orderBy('order')
            ->where('isShow', true);
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
        return $this->gradebookRows()->sum('score');
    }

    public static function getTotalStudent($topic, $student)
    {
        return DB::table('gradebook_row_user')
            ->select(DB::raw('sum(gradebook_row_user.score) as total'))
            ->leftJoin('gradebook_rows','gradebook_row_user.gradebook_row_id', '=', 'gradebook_rows.id')
            ->where('gradebook_row_user.user_id', $student->id)
            ->where('gradebook_rows.topic_id', $topic->id)
            ->first()->total;
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

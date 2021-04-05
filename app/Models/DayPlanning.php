<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPlanning extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'activities' => 'array',
        'created_at' => 'datetime:d-m-y h:m',
    ];


    public function weeklyPlanning()
    {
        return $this->belongsTo(WeeklyPlanning::class);
    }
}

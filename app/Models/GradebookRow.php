<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradebookRow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'activity_id',
        'user_id',
        'comment',
        'score',
        'created_at'
    ];

    protected $with = ['activityable'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start' => 'date:d-m-Y',
        'end' => 'date:d-m-Y',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('score', 'comment', 'file', 'created_at', 'updated_at');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function activityable()
    {
        return $this->morphTo();
    }
}

<?php

namespace App\Models;

use App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'course_id',
        'expires',
    ];

    protected $casts = [
        'expires' => 'datetime',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}

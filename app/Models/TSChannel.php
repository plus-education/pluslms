<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TSChannel extends Model
{
    use HasFactory;

    protected $table = 't_s_channels';

    protected $fillable = [
        'channel_id',  // Thingspeak API use
        'api_key',  // To write data
        'manage_api_key',  // To manage channel (e.g: delete it)
        'user_id',
        'course_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
}

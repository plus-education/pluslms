<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}

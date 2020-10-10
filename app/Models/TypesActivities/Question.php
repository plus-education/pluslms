<?php

namespace App\Models\TypesActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function questionable()
    {
        return $this->morphTo();
    }
}

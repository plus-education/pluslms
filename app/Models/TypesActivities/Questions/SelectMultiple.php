<?php

namespace App\Models\TypesActivities\Questions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelectMultiple extends Model
{
    use HasFactory;

    protected $casts = [
        'options' => 'array'
    ];

    public function question()
    {
        return $this->morphOne( Question::class, 'questionable');
    }


    public function questionOptions()
    {
        return $this->hasMany(QuestionOption::class);
    }
}

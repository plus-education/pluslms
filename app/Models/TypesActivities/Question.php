<?php

namespace App\Models\TypesActivities;

use App\Models\TypesActivities\Questions\SelectMultiple;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $appends = ['options'];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function questionable()
    {
        return $this->morphTo();
    }

    public function getOptionsAttribute()
    {
        if ($this->questionable_type == SelectMultiple::class) {
            return $this->getOptions();
        }

        return null;
    }

    private function getOptions()
    {
        return $this->questionable->questionOptions;
    }
}

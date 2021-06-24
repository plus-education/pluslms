<?php

namespace App\Models\TypesActivities;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\TypesActivities\Questions\SelectMultiple;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $appends = ['html', 'options'];

    public function getHtmlAttribute()
    {
        return NovaEditorJs::generateHtmlOutput($this->description);
    }

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
            return true;
        }

        return null;
    }
}

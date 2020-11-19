<?php

namespace App\Models\TypesActivities;

use Advoor\NovaEditorJs\NovaEditorJs;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $appends = ['html'];

    protected $attributes = [
        'time' => 30,
    ];

    const COMPONENT = 'EXERCISE';

    public function getHtmlAttribute()
    {
        return NovaEditorJs::generateHtmlOutput($this->description);
    }

/*    public function activity()
    {
        return $this->morphOne(Activity::class, 'activityable');
    }
*/
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

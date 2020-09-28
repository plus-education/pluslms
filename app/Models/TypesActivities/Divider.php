<?php

namespace App\Models\TypesActivities;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divider extends Model
{
    use HasFactory;

    const COMPONENT = 'DIVIDER';

    protected $appends = ['html'];

    public function getHtmlAttribute()
    {
        return NovaEditorJs::generateHtmlOutput($this->body);
    }
}

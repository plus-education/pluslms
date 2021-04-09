<?php

namespace App\Models\TypesActivities;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use HasFactory;

    const COMPONENT = 'TEXT';

    protected $guarded = [];

    protected $appends = ['html'];

    public function getHtmlAttribute()
    {
        return NovaEditorJs::generateHtmlOutput($this->body);
    }
}

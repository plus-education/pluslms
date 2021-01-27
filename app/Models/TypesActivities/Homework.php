<?php

namespace App\Models\TypesActivities;

use Advoor\NovaEditorJs\NovaEditorJs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    const COMPONENT = 'HOMEWORK';

    protected $appends = ['html', 'userFile'];

    public function getHtmlAttribute()
    {
        return NovaEditorJs::generateHtmlOutput($this->description);
    }

    public function getUserFileAttribute()
    {
        //return auth()->user()->activities->where('id', $this->id)->first()->file;
    }
}

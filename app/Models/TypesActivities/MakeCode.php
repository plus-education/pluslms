<?php

namespace App\Models\TypesActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MakeCode extends Model
{
    //use HasFactory;

    protected $table = 'make_codes';

    protected $fillable = ['link'];

    const COMPONENT = 'MAKECODE';
}

<?php

namespace App\Models\TypesActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class H5P extends Model
{
    //use HasFactory;

    protected $table = 'h5ps';

    protected $fillable = ['link'];

    const COMPONENT = 'H5P';
}

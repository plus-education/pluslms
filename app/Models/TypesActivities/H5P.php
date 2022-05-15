<?php

namespace App\Models\TypesActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class H5P extends Model
{
    //use HasFactory;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // If the string doesn't end with /embed, add it
            if (!preg_match('/^(.*)\/embed(\/?)$/i', $model->link)) {
                $model->link = $model->link . '/embed';
            }
        });
    }

    protected $table = 'h5ps';

    protected $fillable = ['link'];

    const COMPONENT = 'H5P';
}

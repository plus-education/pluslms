<?php

namespace App\Models\TypesActivities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PDF extends Model
{
    use HasFactory;

    protected $table = 'pdfs';

    protected  $appends = ['real_path'];

    const COMPONENT = 'PDF';

    public function getRealPathAttribute()
    {
        return Storage::disk(env('FILESYSTEM_DRIVER'))->temporaryUrl($this->path, now()->addMinutes(30));
    }
}

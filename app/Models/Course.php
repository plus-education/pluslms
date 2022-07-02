<?php

namespace App\Models;

use App\Models\AccessCode;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

use Chelout\RelationshipEvents\Concerns\HasBelongsToManyEvents;

class Course extends Model
{
    use HasFactory;
    use HasUsers;
    use HasBelongsToManyEvents;

    protected $fillable = ['name'];

    protected $appends = ['coverPath'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function access_codes() {
        return $this->hasMany(AccessCode::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function getCoverPathAttribute()
    {
        $random = rand(1,6);
        return is_null($this->cover) ? "/img/courses/covers/cover-{$random}.jpg" : '/storage/' . $this->cover;
    }

    public function ts_channels()
    {
        return $this->hasMany(TSChannel::class);
    }
}

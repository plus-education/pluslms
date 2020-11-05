<?php

namespace App\Models;

use App\Models\TypesActivities\Divider;
use App\Models\TypesActivities\Exercise;
use App\Models\TypesActivities\File;
use App\Models\TypesActivities\Link;
use App\Models\TypesActivities\PDF;
use App\Models\TypesActivities\Text;
use App\Models\TypesActivities\Homework;
use App\Models\TypesActivities\Youtube;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Activity extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $with = ['activityable'];

    protected $appends = ['type'];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    protected $types = [
        Divider::class,
        Exercise::class,
        Text::class,
        File::class,
        Link::class,
        Homework::class,
        PDF::class,
        Youtube::class,
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function activityable()
    {
        return $this->morphTo();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getTypeAttribute()
    {
        if (! in_array($this->activityable_type, $this->types)){
            return false;
        }

        return $this->activityable_type::COMPONENT;
    }
}

<?php namespace App\Models; use Illuminate\Database\Eloquent\Factories\HasFactory; use 
Illuminate\Database\Eloquent\Model; use Spatie\Permission\Traits\HasRoles; class Group extends Model {
    use HasFactory; use HasUsers; protected $casts = [ 'start' => 'datetime', 'end' => 'datetime' ]; public 
    function users() {
        return $this->belongsToMany(User::class)->using(GroupUser::class);
    }
    public function courses() { return $this->hasMany(Course::class);
    }
}

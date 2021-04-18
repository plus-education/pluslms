<?php


namespace App\Repositories\Eloquent;


use App\Models\Roles;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function allWithRole($role)
    {
        return User::role($role)->get();
    }

    public function withTeacherRoleByCourse($course)
    {
        return User::whereHas('courses', function ($query) use($course) {
            $query->where('id', $course->id);
        })
            ->role(Roles::TEACHER)
            ->get();
    }
}

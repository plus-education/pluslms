<?php


namespace App\Models;


trait HasUsers
{
    public function students()
    {
        return $this->users()->role(Roles::STUDENT);
    }

    public function teachers()
    {
        return $this->users()->role(Roles::TEACHER);
    }

    public function admins()
    {
        return $this->users()->whereHas("roles", function ($q) {
            $q->whereIn("name", [Roles::ADMIN, Roles::SUPER_ADMIN]);
        });
    }
}

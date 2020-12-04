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

    public function supervisors()
    {
        return $this->users()->role(Roles::SUPERVISOR);
    }
}

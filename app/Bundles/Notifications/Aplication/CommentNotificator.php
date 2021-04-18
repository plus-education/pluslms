<?php


namespace App\Bundles\Notifications\Aplication;


use App\Notifications\NewComment;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\UserRepositoryInterface;

class CommentNotificator
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function sendToUser($user, $notification)
    {
        $user->notify(new NewComment($notification->toPrimitives()));
    }

    public function sendToUsersWithRole($role, $notification)
    {
        $this->userRepository->allWithRole($role)->each(function ($user) use ($notification) {
            $this->sendToUser($user, $notification);
        });
    }

    public function sendToTeacherCourse($course, $notification)
    {
        $this->userRepository->withTeacherRoleByCourse($course)->each(function ($user) use ($notification) {
            $this->sendToUser($user, $notification);
        });
    }
}

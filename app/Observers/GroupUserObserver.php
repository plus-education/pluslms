<?php

namespace App\Observers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;

class GroupUserObserver
{
    /**
     * Handle the group user "created" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function created(GroupUser $groupUser)
    {
        $group = Group::find($groupUser->group_id);
        $user = User::find($groupUser->user_id);

        $user->courses()->sync($group->courses);
    }

    /**
     * Handle the group user "updated" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function updated(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the group user "deleted" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function deleted(GroupUser $groupUser)
    {
        // @todo detach user when deleted from group
    }

    /**
     * Handle the group user "restored" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function restored(GroupUser $groupUser)
    {
        //
    }

    /**
     * Handle the group user "force deleted" event.
     *
     * @param  \App\Models\GroupUser  $groupUser
     * @return void
     */
    public function forceDeleted(GroupUser $groupUser)
    {
        //
    }
}

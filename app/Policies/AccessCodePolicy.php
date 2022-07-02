<?php

namespace App\Policies;

use App\Models\AccessCode;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccessCodePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->can('list access codes');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccessCode  $accessCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, AccessCode $accessCode)
    {
        return $user->can('show access code');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create access code');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccessCode  $accessCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, AccessCode $accessCode)
    {
        return $user->can('update access code');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccessCode  $accessCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, AccessCode $accessCode)
    {
        return $user->can('delete access code');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccessCode  $accessCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, AccessCode $accessCode)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\AccessCode  $accessCode
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, AccessCode $accessCode)
    {
        //
    }
}

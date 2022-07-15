<?php

namespace App\Policies;

use App\Models\Dispatch;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DispatchPolicy
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
        return $user->can('viewAny dispatch');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Dispatch $dispatch)
    {
        return $user->can('view dispatch');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create dispatch');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Dispatch $dispatch)
    {
        return $user->can('update dispatch');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Dispatch $dispatch)
    {
        return $user->can('delete dispatch');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Dispatch $dispatch)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Dispatch  $dispatch
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Dispatch $dispatch)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\Models\Receiving;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReceivingPolicy
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
        return $user->can('viewAny receiving');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Receiving $receiving)
    {
        return $user->can('view receiving');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->can('create receiving');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Receiving $receiving)
    {
        return $user->can('update receiving');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Receiving $receiving)
    {
        return $user->can('delete receiving');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Receiving $receiving)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Receiving $receiving)
    {
        //
    }
}

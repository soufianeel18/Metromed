<?php

namespace App\Policies;

use App\Bon;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BonPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef stock' || $user->role == 'agent stock';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bon  $bon
     * @return mixed
     */
    public function view(User $user, Bon $bon)
    {
         return $user->role == 'admin' || $user->role == 'chef stock' || $user->role == 'agent stock';
    }

    public function viewHistory(User $user, Bon $bon)
    {
         return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bon  $bon
     * @return mixed
     */
    public function update(User $user, Bon $bon)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bon  $bon
     * @return mixed
     */
    public function delete(User $user, Bon $bon)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bon  $bon
     * @return mixed
     */
    public function restore(User $user, Bon $bon)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Bon  $bon
     * @return mixed
     */
    public function forceDelete(User $user, Bon $bon)
    {
        //
    }
}

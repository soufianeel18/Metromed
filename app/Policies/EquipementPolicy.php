<?php

namespace App\Policies;

use App\Equipement;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipementPolicy
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
        
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Equipement  $equipement
     * @return mixed
     */
    public function view(User $user, Equipement $equipement)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien';
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Equipement  $equipement
     * @return mixed
     */
    public function update(User $user, Equipement $equipement)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Equipement  $equipement
     * @return mixed
     */
    public function delete(User $user, Equipement $equipement)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Equipement  $equipement
     * @return mixed
     */
    public function restore(User $user, Equipement $equipement)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Equipement  $equipement
     * @return mixed
     */
    public function forceDelete(User $user, Equipement $equipement)
    {
        //
    }
}

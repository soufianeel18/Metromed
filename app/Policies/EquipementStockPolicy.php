<?php

namespace App\Policies;

use App\EquipementStock;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EquipementStockPolicy
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
     * @param  \App\EquipementStock  $equipementStock
     * @return mixed
     */
    public function view(User $user, EquipementStock $equipementStock)
    {
    }

    public function viewHistory(User $user, EquipementStock $equipementStock)
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
     * @param  \App\EquipementStock  $equipementStock
     * @return mixed
     */
    public function update(User $user, EquipementStock $equipementStock)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\EquipementStock  $equipementStock
     * @return mixed
     */
    public function delete(User $user, EquipementStock $equipementStock)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\EquipementStock  $equipementStock
     * @return mixed
     */
    public function restore(User $user, EquipementStock $equipementStock)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\EquipementStock  $equipementStock
     * @return mixed
     */
    public function forceDelete(User $user, EquipementStock $equipementStock)
    {
        //
    }
}

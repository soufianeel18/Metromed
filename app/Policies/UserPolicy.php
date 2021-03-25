<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $user->role == 'admin' || $user->role == 'chef technicien' || $user->role == 'chef commercial' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->role == 'admin' || (($user->role == 'chef technicien' || $user->role == 'technicien') && ($model->role == 'technicien')) || (($user->role == 'chef commercial' || $user->role == 'commercial') && ($model->role == 'commercial'));
    }

    public function viewHistory(User $user, User $model)
    {
        return ($user->role == 'admin' && $model->id == $user->id) || ($user->role == 'admin' && $model->role != 'admin') || ($user->role == 'chef technicien' && $model->role == 'technicien') || ($user->role == 'chef commercial' && $model->role == 'commercial') || ($user->role == 'chef stock' && $model->role == 'agent stock');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien' || $user->role == 'chef commercial' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return ($user->role == 'admin' && $model->role != 'admin') || ($user->role == 'chef technicien' && $model->role == 'technicien') || ($user->role == 'chef commercial' && $model->role == 'commercial') || ($user->role == 'chef stock' && $model->role == 'agent stock') || $user->id == $model->id;
    }

    public function updateRole(User $user, User $model)
    {
        return ($user->role == 'admin' && $model->role != 'admin') || ($user->role == 'chef technicien' && $model->role == 'technicien') || ($user->role == 'chef commercial' && $model->role == 'commercial') || ($user->role == 'chef stock' && $model->role == 'agent stock');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->role == 'admin' || ($user->role == 'chef technicien' && $model->role == 'technicien') || ($user->role == 'chef commercial' && $model->role == 'commercial') || ($user->role == 'chef stock' && $model->role == 'agent stock') || $user->username == $model->username;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}

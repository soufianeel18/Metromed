<?php

namespace App\Policies;

use App\Piece;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PiecePolicy
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
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function view(User $user, Piece $piece)
    {
    }

    public function viewHistory(User $user, Piece $piece)
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
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function update(User $user, Piece $piece)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function delete(User $user, Piece $piece)
    {
        return $user->role == 'admin' || $user->role == 'chef stock';
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function restore(User $user, Piece $piece)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Piece  $piece
     * @return mixed
     */
    public function forceDelete(User $user, Piece $piece)
    {
        //
    }
}

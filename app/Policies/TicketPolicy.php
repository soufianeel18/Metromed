<?php

namespace App\Policies;

use App\Ticket;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
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
        return $user->role == 'admin' || $user->role == 'chef technicien' || $user->role == 'chef commercial' || $user->role == 'commercial' || $user->role == 'technicien';
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function view(User $user, Ticket $ticket)
    {
        return $user->role == 'admin' || (($user->role == 'chef technicien' || $user->role == 'technicien') && ($ticket->user->role == 'technicien')) || (($user->role == 'chef commercial' || $user->role == 'commercial') && ($ticket->user->role == 'commercial'));
    }

    public function viewHistory(User $user, Ticket $ticket)
    {
        return $user->role == 'admin' || ($user->role == 'chef technicien' && $ticket->user->role == 'technicien') || ($user->role == 'chef commercial' && $ticket->user->role == 'commercial');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function createTicketTech(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien';
    }

    public function createTicketAdmin(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef technicien' || $user->role == 'chef commercial';
    }
    
    public function createTicketComm(User $user)
    {
        return $user->role == 'admin' || $user->role == 'chef commercial';
    }

    public function createComment(User $user, Ticket $ticket)
    {
        return $user->role == 'admin' || ($user->role == 'chef technicien' && $ticket->user->role == 'technicien') || ($user->role == 'chef commercial' && $ticket->user->role == 'commercial') || $ticket->user->username == $user->username;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function update(User $user, Ticket $ticket)
    {
        return $user->role == 'admin' || ($user->role == 'chef technicien' && $ticket->user->role == 'technicien') || ($user->role == 'chef commercial' && $ticket->user->role == 'commercial');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function delete(User $user, Ticket $ticket)
    {
        return $user->role == 'admin' || ($user->role == 'chef technicien' && $ticket->user->role == 'technicien') || ($user->role == 'chef commercial' && $ticket->user->role == 'commercial');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function restore(User $user, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Ticket  $ticket
     * @return mixed
     */
    public function forceDelete(User $user, Ticket $ticket)
    {
        //
    }
}

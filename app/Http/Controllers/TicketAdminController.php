<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Ticket;
use \App\User;

class TicketAdminController extends Controller
{
	public function __construct() {
    	$this->middleware('auth');
    }

    public function show(Ticket $ticket) {
        $this->authorize('view', $ticket);

        $comments = collect($ticket->comments)->sortBy('created_at');
        $techniciens = User::where('role', '=', 'technicien')->where('id', '!=', $ticket->user->id)->get();
        $commerciaux = User::where('role', '=', 'commercial')->where('id', '!=', $ticket->user->id)->get();
        return view('tickets-admin.show', compact('ticket', 'comments', 'techniciens', 'commerciaux'));
    }

    public function history(Ticket $ticket) {
        $this->authorize('viewHistory', $ticket);
        
        $events = collect($ticket->events)->sortByDesc('date');

        return view('tickets-admin.history', compact('ticket', 'events'));
    }

    public function store(User $user) {
        $this->authorize('createTicketAdmin', \App\Ticket::class);

        $data = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'commentary' => 'required',
            'type' => '',
        ]);

        $ticket = $user->tickets()->create([
            'title' => str_replace("'", " ", $data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'status' => 'en cours',
        ]);

        $ticket->comments()->create([
            'user_id' => auth()->user()->id,
            'text' => $data['commentary'],
        ]);

        if($user->role == 'technicien') {
            return redirect('/technicien/' . $user->id);
        } else if($user->role == 'commercial') {
            return redirect('/commercial/' . $user->id);
        }
    }

    public function update(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'type' => '',
        ]);

        $ticket->update([
            'title' => str_replace("'", " ", $data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
        ]);
        
        return redirect("/ticket-admin/" . $ticket->id);
    }

    public function updateStatus(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'status' => '',
        ]);

        $ticket->status = $data['status'];
        $ticket->update();

       	return redirect("/ticket-admin/" . $ticket->id);
    }

    public function updateRessource(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'id' => 'required',
        ]);

        $ticket->user_id = $data['id'];
        $ticket->update();

        return redirect("/ticket-admin/" . $ticket->id);
    }

    public function destroy(Ticket $ticket) {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        if($ticket->user->role == 'technicien') {
            return redirect("/technicien/" . $ticket->user->id);    
        } else if($ticket->user->role == 'commercial') {
            return redirect("/commercial/" . $ticket->user->id);
        }
    }
}

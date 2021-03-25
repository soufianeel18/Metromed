<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Ticket;
use \App\User;
use \App\Equipement;

class TicketTechController extends Controller
{
	public function __construct() {
    	$this->middleware('auth');
    }

    public function show(Ticket $ticket) {
        $this->authorize('view', $ticket);
        
        $comments = collect($ticket->comments)->sortBy('created_at');
        $techniciens = User::where('role', '=', 'technicien')->where('id', '!=', $ticket->user->id)->get();
    	return view('tickets-tech.show', compact('ticket', 'comments', 'techniciens'));
    }

    public function history(Ticket $ticket) {
        $this->authorize('viewHistory', $ticket);
        
        $events = collect($ticket->events)->sortByDesc('date');

        return view('tickets-tech.history', compact('ticket', 'events'));
    }

    public function create(User $user, Equipement $equipement) {
        $this->authorize('createTicketTech', \App\Ticket::class);

        return view('tickets-tech.create', compact('user', 'equipement'));
    }

    public function store(User $user, Equipement $equipement) {
        $this->authorize('createTicketTech', \App\Ticket::class);

        $data = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'type' => ''
        ]);

        $user->tickets()->create([
            'equipement_id' => $equipement->id,
            'title' => str_replace("'", " ", $data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'type' => $data['type'],
            'status' => 'en cours',
        ]);

        return redirect('/technicien/' . $user->id);
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
        
        return redirect("/ticket-tech/" . $ticket->id);
    }

    public function updateStatus(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'status' => '',
        ]);

        $ticket->status = $data['status'];
        $ticket->update();

       	return redirect("/ticket-tech/" . $ticket->id);
    }

    public function updateRessource(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'id' => 'required',
        ]);

        $ticket->user_id = $data['id'];
        $ticket->update();

        return redirect("/ticket-tech/" . $ticket->id);
    }

    public function destroy(Ticket $ticket) {
        $this->authorize('delete', $ticket);

        $ticket->delete();
        
        return redirect("/technicien/" . $ticket->user->id);
    }
}

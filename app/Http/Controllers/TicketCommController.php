<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Ticket;
use \App\User;
use \App\Client;

class TicketCommController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function show(Ticket $ticket) {
        $this->authorize('view', $ticket);

        $comments = collect($ticket->comments)->sortBy('created_at');
        $commerciaux = User::where('role', '=', 'commercial')->where('id', '!=', $ticket->user->id)->get();
        return view('tickets-comm.show', compact('ticket', 'comments', 'commerciaux'));
    }

    public function history(Ticket $ticket) {
        $this->authorize('viewHistory', $ticket);
        
        $events = collect($ticket->events)->sortByDesc('date');

        return view('tickets-comm.history', compact('ticket', 'events'));
    }

    public function create(User $user, Client $client) {
        $this->authorize('createTicketComm', \App\Ticket::class);

        return view('tickets-comm.create', compact('user', 'client'));
    }

    public function store(User $user, Client $client) {
        $this->authorize('createTicketComm', \App\Ticket::class);

        $data = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'commentary' => 'required',
        ]);

        $ticket = $user->tickets()->create([
            'client_id' => $client->id,
            'title' => str_replace("'", " ", $data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => 'en cours',
        ]);

        $ticket->comments()->create([
            'user_id' => auth()->user()->id,
            'text' => $data['commentary'],
        ]);

        return redirect('/commercial/' . $user->id);
    }

    public function update(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'title' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
        ]);

        $ticket->update([
            'title' => str_replace("'", " ", $data['title']),
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
        ]);
        
        return redirect("/ticket-comm/" . $ticket->id);
    }

    public function updateStatus(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'status' => '',
        ]);

        $ticket->status = $data['status'];
        $ticket->update();

       	return redirect("/ticket-comm/" . $ticket->id);
    }

    public function updateRessource(Ticket $ticket) {
        $this->authorize('update', $ticket);

        $data = request()->validate([
            'id' => 'required',
        ]);

        $ticket->user_id = $data['id'];
        $ticket->update();

        return redirect("/ticket-comm/" . $ticket->id);
    }

    public function destroy(Ticket $ticket) {
        $this->authorize('delete', $ticket);
        
        $ticket->delete();

        return redirect("/commercial/" . $ticket->user->id);
    }
}

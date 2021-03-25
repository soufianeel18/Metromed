<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Equipement;
use \App\User;
use \App\Ticket;
use \App\Client;
use \App\Market;

class TicketController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
        $this->authorize('viewAny', \App\Ticket::class);

        $cle = null;
        if(auth()->user()->role == 'chef technicien' || auth()->user()->role == 'technicien') {
            $tickets = collect(Ticket::whereIn('user_id', User::where('role', '=', 'technicien')->pluck('id')->toArray())->get())->sortByDesc('start_date');
        }

        if(auth()->user()->role == 'chef commercial' || auth()->user()->role == 'commercial') {
            $tickets = collect(Ticket::whereIn('user_id', User::where('role', '=', 'commercial')->pluck('id')->toArray())->get())->sortByDesc('start_date');
        }

        if(auth()->user()->role == 'admin') {
            $tickets = collect(Ticket::all())->sortByDesc('start_date');
        }

        return view('tickets.index', compact('tickets', 'cle'));
    }

    public function search() {
        $this->authorize('viewAny', \App\Ticket::class);

        if(auth()->user()->role == 'chef technicien' || auth()->user()->role == 'technicien') {
            $tickets = Ticket::whereIn('user_id', User::where('role', '=', 'technicien')->pluck('id')->toArray())->get();
        }

        if(auth()->user()->role == 'chef commercial' || auth()->user()->role == 'commercial') {
            $tickets = Ticket::whereIn('user_id', User::where('role', '=', 'commercial')->pluck('id')->toArray())->get();
        }

        if(auth()->user()->role == 'admin') {
            $tickets = Ticket::all();
        }
        
        $data = request();
        $cle = $data['cle'];

        if($cle == 'technique') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->whereNotNull('equipement_id')->get())->sortByDesc('start_date');
        } else if($cle == 'commerciale') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->whereNotNull('client_id')->get())->sortByDesc('start_date');
        } else if($cle == 'administrative') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->whereNull('client_id')->whereNull('equipement_id')->get())->sortByDesc('start_date');
        } else if($cle == 'en cours') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->where('status', '=', 'en cours')->get())->sortByDesc('start_date');
        } else if($cle == 'fermée') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->where('status', '=', 'fermée')->get())->sortByDesc('start_date');
        } else if($cle == 'archivée') {
            $tickets = collect(Ticket::whereIn('id', $tickets->pluck('id')->toArray())->where('status', '=', 'archivée')->get())->sortByDesc('start_date');
        } else {
            $users_id = User::where('name', 'like', "%$cle%")->pluck('id')->toArray();

            $markets_id = Market::where('n_market', 'like', "%$cle%")
            ->orWhere('ville', 'like', "%$cle%")->pluck('id')->toArray();

            $clients_id = Client::where('name', 'like', "%$cle%")
            ->orWhereIn('market_id', $markets_id)->pluck('id')->toArray();
            
            $equipements_id = Equipement::where('designation', 'like', "%$cle%")
            ->orWhere('model', 'like', "%$cle%")
            ->orWhere('marque', 'like', "%$cle%")
            ->orWhereIn('client_id', $clients_id)->pluck('id')->toArray();

            $ticketsTmp = Ticket::where('title', 'like', "%$cle%")
            ->orWhere('start_date', 'like', "%$cle%")
            ->orWhere('end_date', 'like', "%$cle%")
            ->orWhere('type', 'like', "%$cle%")
            ->orWhereIn('user_id', $users_id)
            ->orWhereIn('client_id', $clients_id)
            ->orWhereIn('equipement_id', $equipements_id)->get();

            $tickets = Ticket::whereIn('id', $tickets->pluck('id')->toArray())
            ->whereIn('id', $ticketsTmp->pluck('id')->toArray())->get();

            $tickets = collect($tickets)->sortByDesc('start_date');
        }

        return view('tickets.index', compact('tickets', 'cle'));
    }
}

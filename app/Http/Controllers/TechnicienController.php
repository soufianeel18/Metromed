<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Equipement;
use \App\Client;

class TechnicienController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function show(User $user) {
        $this->authorize('view', $user);

        if($user->role == 'technicien') {
            $clientsMarket_id = Client::whereNotNull('market_id')->pluck('id')->toArray();
            $clientsBon_id = Client::whereNull('market_id')->pluck('id')->toArray();
            
            $equipementsMarket = Equipement::whereIn('client_id', $clientsMarket_id)->get();
            $equipementsBon = Equipement::whereIn('client_id', $clientsBon_id)->get();
            
            $tickets = [];
        	foreach ($user->tickets as $ticket) {
                if($ticket->equipement_id == null) {
                    $path = '/ticket-admin/';
                } else {
                    $path = '/ticket-tech/';
                }

                array_push($tickets, ['title' => $ticket->title,
                    'start' => $ticket->start_date,
                    'end' => $ticket->end_date,
                    'backgroundColor' => $ticket->user->color,
                    'textColor' => ($ticket->user->color <= '#aaaaaa') ? 'white' : 'black',
                    'borderColor' => $ticket->user->color,
                    'url' => $path . $ticket->id]);
            }

            return view('techniciens.show', compact('user', 'tickets', 'equipementsMarket', 'equipementsBon'));
        }
    }
}
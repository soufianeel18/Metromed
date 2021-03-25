<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Client;

class CommercialController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function show(User $user) {
        $this->authorize('view', $user);
        
        if($user->role == 'commercial') {
            $clientsMarket = Client::whereNotNull('market_id')->get();
            $clientsBon = Client::whereNull('market_id')->get();
            $tickets = [];
        	foreach ($user->tickets as $ticket) {

                if($ticket->client_id == null) {
                    $path = '/ticket-admin/';
                } else {
                    $path = '/ticket-comm/';
                }

                array_push($tickets, ['title' => $ticket->title,
                    'start' => $ticket->start_date,
                    'end' => $ticket->end_date,
                    'backgroundColor' => $ticket->user->color,
                    'textColor' => ($ticket->user->color <= '#aaaaaa') ? 'white' : 'black',
                    'borderColor' => $ticket->user->color,
                    'url' => $path . $ticket->id]);
            }

            return view('commerciaux.show', compact('user', 'tickets', 'clientsMarket', 'clientsBon'));
        }
    }
}

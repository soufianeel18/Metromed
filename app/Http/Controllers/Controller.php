<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use \App\User;
use \App\Ticket;
use \App\Bon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        if(auth()->user()->role == 'admin') {
            $techniciens = User::where('role', '=', 'technicien')->get();
            $commerciaux = User::where('role', '=', 'commercial')->get();
            $ticketsTmp = Ticket::all();
            $tickets = [];

            foreach ($ticketsTmp as $ticket) {
                if($ticket->client_id == null) {
                    if($ticket->equipement_id == null) {
                        $path = '/ticket-admin/';
                    } else {
                        $path = '/ticket-tech/';
                    }
                } else {
                    $path = '/ticket-comm/';
                }

                array_push($tickets, ['title' => $ticket->title,
                    'start' => $ticket->start_date,
                    'end' => $ticket->end_date,
                    'backgroundColor' => $ticket->user->color,
                    'textColor' => ($ticket->user->color <= '#aaaaaa') ? 'white' : 'black',
                    'borderColor' => $ticket->user->color,
                    'url' => $path . $ticket->id
                ]);
            }
            return view('index', compact('techniciens', 'commerciaux', 'tickets'));
        } else if(auth()->user()->role == 'chef stock' || auth()->user()->role == 'agent stock') {
            return redirect('/home-stock');
        } else if(auth()->user()->role == 'chef technicien' || auth()->user()->role == 'technicien') {
            return redirect('/home-tech');
        } else if(auth()->user()->role == 'chef commercial' || auth()->user()->role == 'commercial') {
            return redirect('/home-comm');
            $ticketsTmp = Ticket::whereIn('user_id', User::where('role', '=', 'commercial')->pluck('id')->toArray())->get();
        } else if(auth()->user()->role == 'guest') {
            return redirect('/home-guest');
        }
    }

    public function indexStock() {
        if(auth()->user()->role != 'chef stock' && auth()->user()->role != 'agent stock' && auth()->user()->role != 'admin') {
            return redirect('/home');
        }
        
        $bons = [];

        foreach (Bon::all() as $bon) {
            if($bon->piece_id == null) {
                $nom = $bon->equipementStock->designation;
            } else {
                $nom = $bon->piece->designation;
            }
            $couleur = '#' . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15)) . dechex(random_int(0,15));
            if($bon->type == 'entrée') {
                $titre = "Bon d entrée : $nom";
                $path = '/bon-entree/';
            } else {
                $titre = "Bon de sortie : $nom";
                $path = '/bon-sortie/';
            }

            array_push($bons, ['title' => $titre,
                'start' => $bon->date,
                'end' => $bon->date,
                'backgroundColor' => $couleur,
                'textColor' => ($couleur <= '#aaaaaa') ? 'white' : 'black',
                'borderColor' => $couleur,
                'url' => $path . $bon->id
            ]);
        }

        return view('indexStock', compact('bons'));
    }

    public function indexTech() {
        if(auth()->user()->role != 'chef technicien' && auth()->user()->role != 'technicien') {
            return redirect('/home');
        }

        $techniciens = User::where('role', '=', 'technicien')->get();
        $ticketsTmp = Ticket::whereIn('user_id', User::where('role', '=', 'technicien')->pluck('id')->toArray())->get();
        $tickets = [];

        foreach ($ticketsTmp as $ticket) {
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
                'url' => $path . $ticket->id
            ]);
        }

        return view('indexTech', compact('techniciens', 'tickets'));
    }

    public function indexComm() {
        if(auth()->user()->role != 'chef commercial' && auth()->user()->role != 'commercial') {
            return redirect('/home');
        }

        $commerciaux = User::where('role', '=', 'commercial')->get();
        $ticketsTmp = Ticket::whereIn('user_id', User::where('role', '=', 'commercial')->pluck('id')->toArray())->get();
        $tickets = [];

        foreach ($ticketsTmp as $ticket) {
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
                'url' => $path . $ticket->id
            ]);
        }

        return view('indexComm', compact('commerciaux', 'tickets'));
    }

    public function indexGuest() {
        if(auth()->user()->role != 'guest') {
            return redirect('/home');
        }
        return view('indexGuest');
    }
}

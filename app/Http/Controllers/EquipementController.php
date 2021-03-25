<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Client;
use \App\Equipement;

class EquipementController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function show(Equipement $equipement) {
        $this->authorize('update', $equipement);

        $events = collect($equipement->events)->sortByDesc('date');

        return view('equipements.show', compact('equipement', 'events'));
    }

    public function create(Client $client) {
        $this->authorize('create', \App\Equipement::class);

    	return view('equipements.create', compact('client'));
    }

    public function store(Client $client) {
        $this->authorize('create', \App\Equipement::class);

    	$data = request()->validate([
    		'designation' => 'required',
    		'marque' => 'required',
    		'model' => 'required',
    		'n_inv' => '',
    		'date_mise_service' => 'nullable|before_or_equal:now',
    		'fonctionnel' => '',
    	]);

    	$client->equipements()->create([
    		'designation' => $data['designation'],
    		'marque' => $data['marque'],
    		'model' => $data['model'],
    		'n_inv' => $data['n_inv'],
    		'date_mise_service' => $data['date_mise_service'],
    		'fonctionnel' => $data['fonctionnel'],
    	]);

        if($client->market_id == null) {
            return redirect('/client-bon-de-commande');
        } else {
            return redirect('/market');
        }
    }

    public function edit(Equipement $equipement) {
        $this->authorize('update', $equipement);

        return view('equipements.edit', compact('equipement'));
    }

    public function update(Equipement $equipement) {
        $this->authorize('update', $equipement);

        $data = request()->validate([
            'designation' => 'required',
            'marque' => 'required',
            'model' => 'required',
            'n_inv' => '',
            'date_mise_service' => 'nullable|before_or_equal:now',
            'fonctionnel' => '',
        ]);

        $equipement->update($data);

        if($equipement->client->market_id == null) {
            return redirect('/client-bon-de-commande');
        } else {
            return redirect('/market');
        }
    }

    public function destroy(Equipement $equipement) {
        $this->authorize('delete', $equipement);

        $equipement->delete();

        if($equipement->client->market_id == null) {
            return redirect('/client-bon-de-commande');
        } else {
            return redirect('/market');
        }
    }
}

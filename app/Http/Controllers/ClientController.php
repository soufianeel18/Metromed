<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Market;
use \App\Client;

class ClientController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
        $this->authorize('viewAny', \App\Client::class);

        $clients = Client::whereNull('market_id')->get();
        
        return view('clients.index',compact('clients'));
    }

    public function show(Client $client) {
        $this->authorize('view', $client);

        $events = collect($client->events)->sortByDesc('date');

        return view('clients.show', compact('client', 'events'));
    }

    public function create(Market $market) {
        $this->authorize('create', \App\Client::class);

        $isMarket = true;
        if($market->id == null) {
            $isMarket = false;
            return view('clients.create', compact('isMarket'));
        } else {
            return view('clients.create', compact('market', 'isMarket'));
        }
    }

    public function store(Market $market) {
        $this->authorize('create', \App\Client::class);

    	$data = request()->validate([
    		'name' => 'required|string',
            'phone' => 'nullable|numeric|unique:clients',
    	]);

        if($market->id == null) {
            Client::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);

            return redirect('/client-bon-de-commande');
        } else {
            $market->clients()->create([
                'name' => $data['name'],
                'phone' => $data['phone'],
            ]);

            return redirect('/market');
        }
    }

    public function edit(Client $client) {
        $this->authorize('update', $client);

        return view('clients.edit', compact('client'));
    }

    public function update(Client $client) {
        $this->authorize('update', $client);

        $data = request()->validate([
            'name' => 'required|string',
            'phone' => 'nullable|numeric',
        ]);

        $client->update($data);

        if($client->market_id == null) {
            return redirect('/client-bon-de-commande');
        } else {
            return redirect('/market');
        }
    }

    public function destroy(Client $client) {
        $this->authorize('delete', $client);

        $client->delete();

        if($client->market_id == null) {
            return redirect('/client-bon-de-commande');
        } else {
            return redirect('/market');
        }
    }
}

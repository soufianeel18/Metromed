<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Market;

class MarketController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
        $this->authorize('viewAny', \App\Market::class);

    	$markets = Market::all();

    	return view('markets.index',compact('markets'));
    }

    public function show(Market $market) {
        $this->authorize('view', $market);

        $events = collect($market->events)->sortByDesc('date');

        return view('markets.show', compact('market', 'events'));
    }

    public function create() {
        $this->authorize('create', \App\Market::class);

        return view('markets.create');
    }

    public function store() {
        $this->authorize('create', \App\Market::class);
        
    	$data = request()->validate([
    		'n_market' => 'required|unique:markets',
    		'ville' => 'required',
    	]);

    	Market::create([
    		'n_market' => $data['n_market'],
    		'ville' => $data['ville'],
    	]);

    	return redirect('/market');
    }

    public function edit(Market $market) {
        $this->authorize('update', $market);

        return view('markets.edit', compact('market'));
    }

    public function update(Market $market) {
        $this->authorize('update', $market);
        
        $data = request()->validate([
            'n_market' => 'required',
            'ville' => 'required',
        ]);

        $market->update($data);

        return redirect('/market');
    }

    public function destroy(Market $market) {
        $this->authorize('delete', $market);

        $market->delete();

        return redirect('/market');
    }
}

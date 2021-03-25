<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\EquipementStock;
use \App\Piece;

class EquipementStockController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
        $this->authorize('viewAny', \App\EquipementStock::class);

    	$equipementStocks = EquipementStock::all();
        $pieces = Piece::all();

    	return view('equipements-stock.index', compact('equipementStocks', 'pieces'));
    }

    public function history(EquipementStock $equipement_stock) {
        $this->authorize('viewHistory', $equipement_stock);

        $events = collect($equipement_stock->events)->sortByDesc('date');

        return view('equipements-stock.history', compact('equipement_stock', 'events'));
    }

    public function create() {
        $this->authorize('create', \App\EquipementStock::class);

    	return view('equipements-stock.create');
    }

    public function store() {
        $this->authorize('create', \App\EquipementStock::class);

    	$data = request()->validate([
    		'designation' => 'required',
    		'marque' => 'required',
    		'model' => 'required',
    		'n_inv' => '',
    		'quantite' => 'required|numeric|gt:0',
    	]);

    	EquipementStock::create([
    		'designation' => $data['designation'],
    		'marque' => $data['marque'],
    		'model' => $data['model'],
    		'n_inv' => $data['n_inv'],
    		'quantite' => $data['quantite'],
    	]);
        
        return redirect('/stock');
    }

    public function edit(EquipementStock $equipement_stock) {
        $this->authorize('update', $equipement_stock);

        return view('equipements-stock.edit', compact('equipement_stock'));
    }

    public function update(EquipementStock $equipement_stock) {
        $this->authorize('update', $equipement_stock);

        $data = request()->validate([
            'designation' => 'required',
            'marque' => 'required',
            'model' => 'required',
            'n_inv' => '',
            'quantite' => 'required|numeric|gt:0',
        ]);

        $equipement_stock->update($data);

        return redirect('/stock');
    }

    public function destroy(EquipementStock $equipement_stock) {
        $this->authorize('delete', $equipement_stock);

        $equipement_stock->delete();

        return redirect('/stock');
    }
}

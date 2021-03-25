<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\EquipementStock;
use \App\Piece;
use \App\Bon;

class BonEntreeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function show(Bon $bon) {
        $this->authorize('view', $bon);

        return view('bons-entree.show', compact('bon'));
    }

    public function history(Bon $bon) {
        $this->authorize('viewHistory', $bon);

        $events = collect($bon->events)->sortByDesc('date');

        return view('bons-entree.history', compact('bon', 'events'));
    }

    public function create() {
        $this->authorize('create', \App\Bon::class);

        $equipementStocks = EquipementStock::all();
        $pieces = Piece::all();

        return view('bons-entree.create', compact('equipementStocks', 'pieces'));    
    }

    public function store() {
        $this->authorize('create', \App\Bon::class);
        
        if(isset($_POST['eq_id'])) {
            $id = $_POST['eq_id'];
            $equipement_stock = EquipementStock::find($id);
            $data = request()->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'n_market' => '',
                'ville' => '',
                'date_entree' => 'required|before_or_equal:now',
                'quantite' => 'required|numeric|gt:0',
            ]);

            $equipement_stock->quantite += $data['quantite'];
            $equipement_stock->update();

            $bon = $equipement_stock->bons()->create([
                'cname' => $data['name'],
                'cphone' => $data['phone'],
                'n_market' => $data['n_market'],
                'ville' => $data['ville'],
                'date' => $data['date_entree'],
                'quantite' => $data['quantite'],
                'type' => 'entrée',
            ]);

            if(isset($_POST['eq' . $id])) {
                $pieces = Piece::whereIn('id', $_POST['eq' . $id])->get();
                if($pieces->count() != 0) {
                    foreach ($pieces as $piece) {
                        $pieceLink = $equipement_stock->pieces()->find($piece->id);
                        $quantite_eq = $pieceLink->pivot->quantite_eq;
                        $piece->quantite += $data['quantite'] * $quantite_eq;
                        $piece->update();

                        $bon->bonPieces()->create([
                            'unique_id' => $piece->id,
                            'designation' => $piece->designation,
                            'marque' => $piece->marque,
                            'model' => $piece->model,
                            'n_inv' => $piece->n_inv,
                            'quantite_eq' => $quantite_eq,
                        ]);
                    }
                }     
            }
        } else if(isset($_POST['piece_id'])) {
            $id = $_POST['piece_id'];
            $piece = Piece::find($id);
            $data = request()->validate([
                'name' => 'required',
                'phone' => 'required|numeric',
                'n_market' => '',
                'ville' => '',
                'date_entree' => 'required|before_or_equal:now',
                'quantite' => 'required|numeric|gt:0',
            ]);

            $piece->quantite += $data['quantite'];
            $piece->update();

            $piece->bons()->create([
                'cname' => $data['name'],
                'cphone' => $data['phone'],
                'n_market' => $data['n_market'],
                'ville' => $data['ville'],
                'date' => $data['date_entree'],
                'quantite' => $data['quantite'],
                'type' => 'entrée',
            ]);
        }

        return redirect('/home-stock');  
    }

    public function update(Bon $bon) {
        $this->authorize('update', $bon);

        $data = request()->validate([
            'date' => 'required|before_or_equal:now',
            'cname' => 'required',
            'cphone' => 'required|numeric',
            'n_market' => '',
            'ville' => '',
            'quantite' => 'required|numeric|gt:0',
        ]);

        if($bon->equipement_stock_id != null) {
            $bon->equipementStock->quantite -= $bon->quantite;
            $bon->equipementStock->quantite += $data['quantite'];
            $bon->equipementStock->update();
            if($bon->bonPieces()->count() != 0) {
                $pieces = Piece::whereIn('id', $bon->bonPieces()->pluck('unique_id')->toArray())->get();
                foreach ($pieces as $piece) {
                    $pieceLink = $bon->equipementStock->pieces()->find($piece->id);
                    $quantite_eq = $pieceLink->pivot->quantite_eq;
                    $piece->quantite -= $bon->quantite * $quantite_eq;
                    $piece->quantite += $data['quantite'] * $quantite_eq;
                    $piece->update();
                }
            }
        } else if($bon->piece_id != null) {
            $bon->piece->quantite -= $bon->quantite;
            $bon->piece->quantite += $data['quantite'];
            $bon->piece->update();
        }
        
        $bon->update($data);

        return redirect('/bon-entree/' . $bon->id);
    }

    public function destroy(Bon $bon) {
        $this->authorize('delete', $bon);
        $bon->delete();

        return redirect('/bon');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Piece;
use \App\EquipementStock;

class PieceController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function create(EquipementStock $equipement_stock) {
        $this->authorize('create', \App\Piece::class);

        return view('pieces.create', compact('equipement_stock')); 
    }

    public function history(Piece $piece) {
        $this->authorize('viewHistory', $piece);

        $events = collect($piece->events)->sortByDesc('date');

        return view('pieces.history', compact('piece', 'events'));
    }

    public function choose(EquipementStock $equipement_stock) {
        $this->authorize('create', \App\Piece::class);

        $pieces = Piece::whereNotIn('id', $equipement_stock->pieces()->pluck('pieces.id')->toArray())->get();

        if($pieces->count() == 0) {
            return view('pieces.create', compact('equipement_stock')); 
        }

        return view('pieces.list', compact('equipement_stock', 'pieces'));
    }

    public function store(EquipementStock $equipement_stock) {
        $this->authorize('create', \App\Piece::class);

        $data = request()->validate([
            'designation' => 'required',
            'marque' => 'required',
            'model' => 'required',
            'n_inv' => '',
            'quantite' => 'required|numeric|gt:0',
            'quantite_eq' => 'required|numeric|gt:0',
        ]);

        $piece = Piece::create([
            'designation' => $data['designation'],
            'marque' => $data['marque'],
            'model' => $data['model'],
            'n_inv' => $data['n_inv'],
            'quantite' => $data['quantite'],
        ]);

        $equipement_stock->pieces()->toggle($piece);
        $piece = $equipement_stock->pieces()->find($piece->id);
        $piece->pivot->quantite_eq = $data['quantite_eq'];
        $piece->pivot->save();

        return redirect('/stock');
    }

    public function link(EquipementStock $equipement_stock) {
        $this->authorize('create', \App\Piece::class);

        if(isset($_POST['id'])) {
            $pieces = Piece::whereIn('id', $_POST['id'])->get();
            foreach ($pieces as $piece) {
                $id = $piece->id;
                if($_POST["$id"] != "") {
                    if($_POST["$id"] > 0) {
                        $equipement_stock->pieces()->toggle($piece);
                        $pieceLink = $equipement_stock->pieces()->find($id);
                        $pieceLink->pivot->quantite_eq = $_POST["$id"];
                        $pieceLink->pivot->save();
                    } else {
                        $message = 'La quantité doit être strictement positive.';
                        return view('pieces.alert', compact('message', 'equipement_stock'));
                    }
                } else {
                    $message = 'Veuillez entrer la valeur de la quantité.';
                    return view('pieces.alert', compact('message', 'equipement_stock'));
                }
            }
        } else {
            $message = 'Veuillez choisir une pièce.';
            return view('pieces.alert', compact('message', 'equipement_stock'));
        }

        return redirect('/stock');
    }

    public function edit(Piece $piece) {
        $this->authorize('update', $piece);

        return view('pieces.edit', compact('piece'));
    }

    public function update(Piece $piece) {
        $this->authorize('update', $piece);

        $data = request()->validate([
            'designation' => 'required',
            'marque' => 'required',
            'model' => 'required',
            'n_inv' => '',
            'quantite' => 'required|numeric|gt:0',
        ]);

        $piece->update($data);        

        return redirect('/stock');
    }

    public function editQuantity(EquipementStock $equipement_stock, Piece $piece) {
        $this->authorize('update', $piece);

        return view('pieces.edit_quantity', compact('piece', 'equipement_stock'));
    }

    public function updateQuantity(EquipementStock $equipement_stock, Piece $piece) {
        $this->authorize('update', $piece);

        $data = request()->validate(['quantite_eq' => 'required|numeric|gt:0',]);

        $eq = $piece->equipementStocks()->find($equipement_stock->id);
        $eq->pivot->quantite_eq = $data['quantite_eq'];
        $eq->pivot->save();

        return redirect('/stock');
    }

    public function destroy(Piece $piece) {
        $this->authorize('delete', $piece);

        $piece->delete();

        return redirect('/stock');
    }

    public function unlink(EquipementStock $equipement_stock, Piece $piece) {
        $this->authorize('delete', $piece);
        
        $equipement_stock->pieces()->wherePivot('piece_id', $piece->id)->detach();

        return redirect('/stock');
    }
}

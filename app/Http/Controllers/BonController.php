<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Bon;
use \App\EquipementStock;
use \App\Piece;
use PDF;

class BonController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }

    public function index() {
        $this->authorize('viewAny', \App\Bon::class);

    	$cle = null;
        $bons = collect(Bon::all())->sortByDesc('date');

    	return view('bons.index', compact('bons', 'cle'));
    }

    public function search() {
        $this->authorize('viewAny', \App\Bon::class);

        $data = request();
        $cle = $data['cle'];

        if($cle == 'sortie') {
            $bons = collect(Bon::where('type', '=', 'sortie')->get())->sortByDesc('date');
        } else if($cle == 'entrée') {
            $bons = collect(Bon::where('type', '=', 'entrée')->get())->sortByDesc('date');
        } else if(str_contains($cle, 'piece') || str_contains($cle, 'pièce')) {
            $bons = collect(Bon::whereNotNull('piece_id')->get())->sortByDesc('date');
        } else if(str_contains($cle, 'equipement') || str_contains($cle, 'équipement')) {
            $bons = collect(Bon::whereNotNull('equipement_stock_id')->get())->sortByDesc('date');
        } else {
            $equipements_stock_id = EquipementStock::where('designation', 'like', "%$cle%")
            ->orWhere('model', 'like', "%$cle%")
            ->orWhere('marque', 'like', "%$cle%")
            ->orWhere('n_inv', 'like', "%$cle%")
            ->orWhere('quantite', 'like', "%$cle%")->pluck('id')->toArray();

            $pieces_id = Piece::where('designation', 'like', "%$cle%")
            ->orWhere('model', 'like', "%$cle%")
            ->orWhere('marque', 'like', "%$cle%")
            ->orWhere('n_inv', 'like', "%$cle%")
            ->orWhere('quantite', 'like', "%$cle%")->pluck('id')->toArray();

            $bons = Bon::where('quantite', 'like', "%$cle%")
            ->orWhere('date', 'like', "%$cle%")
            ->orWhere('cname', 'like', "%$cle%")
            ->orWhere('n_market', 'like', "%$cle%")
            ->orWhere('ville', 'like', "%$cle%")
            ->orWhere('type', 'like', "%$cle%")
            ->orWhereIn('piece_id', $pieces_id)
            ->orWhereIn('equipement_stock_id', $equipements_stock_id)->get();

            $bons = collect($bons)->sortByDesc('date');
        }

        return view('bons.index', compact('bons', 'cle'));
    }

    public function printPDF() {
        $this->authorize('create', \App\Bon::class);

        $pdf = PDF::loadView('bons-livraison.index');  
        return $pdf->download('bon_livraison.pdf');
    }
}

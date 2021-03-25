<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bon extends Model
{
    protected $guarded = [];
	
    public function equipementStock() {
    	return $this->belongsTo(EquipementStock::class);
    }

    public function piece() {
    	return $this->belongsTo(Piece::class);
    }

    public function bonPieces() {
    	return $this->hasMany(BonPiece::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($bon){
            $username = auth()->user()->username;
            $date = \Carbon\Carbon::parse($bon->date)->translatedFormat('d F Y à H\hi');
            $quantite = $bon->quantite;
            $client = $bon->cname;

            if($bon->equipement_stock_id != null) {
                if($bon->type == 'entrée') {
                    $description = "$username a créé un bon d'entrée :\nL'équipement est entré le $date d'une quantité de $quantite depuis le client $client";
                } else {
                    $description = "$username a créé un bon de sortie :\nL'équipement est sorti le $date d'une quantité de $quantite vers le client $client";
                }
                $bon->equipementStock->events()->create([
                    'date' => $bon->created_at,
                    'description' => $description,
                ]);
            } else {
                if($bon->type == 'entrée') {
                    $description = "$username a créé un bon d'entrée :\nLa pièce est entrée le $date d'une quantité de $quantite depuis le client $client";
                } else {
                    $description = "$username a créé un bon de sortie :\nLa pièce est sortie le $date d'une quantité de $quantite vers le client $client";
                }
                $bon->piece->events()->create([
                    'date' => $bon->created_at,
                    'description' => $description,
                ]);
            }

            if($bon->type == 'entrée') {
                $description = "$username a créé le bon d'entrée";
            } else {
                $description = "$username a créé le bon de sortie";
            }

            $bon->events()->create([
                'date' => $bon->created_at,
                'description' => $description,
            ]);
        });

        static::updated(function($bon){
            $username = auth()->user()->username;

            foreach ($bon->getChanges() as $key => $value) {
                if($key == 'date') {
                    $old_date = \Carbon\Carbon::parse($bon->getOriginal("$key"))->translatedFormat('d F Y à H\hi');
                    $date = \Carbon\Carbon::parse($value)->translatedFormat('d F Y à H\hi');
                    if($old_date != $date) {
                        if($bon->type == 'entrée') {
                            $description = "$username a changé la date d'entrée : $old_date à $date";
                        } else {
                            $description = "$username a changé la date de sortie : $old_date à $date";
                        }
                        $bon->events()->create([
                            'date' => $bon->updated_at,
                            'description' => $description,
                        ]);
                    }
                } else if($key == 'quantite') {
                    $old_quantite = $bon->getOriginal("$key");
                    $bon->events()->create([
                        'date' => $bon->updated_at,
                        'description' => "$username a changé la quantité : $old_quantite à $value",
                    ]);
                } else if($key == 'cname') {
                    $old_cname = $bon->getOriginal("$key");
                    $bon->events()->create([
                        'date' => $bon->updated_at,
                        'description' => "$username a changé le nom du client : $old_cname à $value",
                    ]);
                } else if($key == 'cphone') {
                    $old_cphone = $bon->getOriginal("$key");
                    $bon->events()->create([
                        'date' => $bon->updated_at,
                        'description' => "$username a changé le numéro de téléphone du client : $old_cphone à $value",
                    ]);
                } else if($key == 'n_market') {
                    $old_n_market = $bon->getOriginal("$key");
                    if($bon->getOriginal("$key") == null) {
                        $description = "$username a ajouté un numéro de marché : $value";
                    } else if($value == null) {
                        $description = "$username a supprimé le numéro de marché";
                    } else {
                        $description = "$username a changé le numéro de marché : $old_n_market à $value";
                    }
                    $bon->events()->create([
                        'date' => $bon->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'ville') {
                    $old_ville = $bon->getOriginal("$key");
                    if($bon->getOriginal("$key") == null) {
                        $description = "$username a ajouté une ville de marché : $value";
                    } else if($value == null) {
                        $description = "$username a supprimé la ville de marché";
                    } else {
                        $description = "$username a changé la ville de marché : $old_ville à $value";
                    }
                    $bon->events()->create([
                        'date' => $bon->updated_at,
                        'description' => $description,
                    ]);
                } 
            }
        });

        static::deleting(function($bon){
            $bon->bonPieces()->delete();
            $bon->events()->delete();
        });
    }
}

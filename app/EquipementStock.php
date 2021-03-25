<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EquipementStock extends Model
{
	protected $guarded = [];
	
    public function pieces() {
    	return $this->belongsToMany(Piece::class)->withPivot('quantite_eq')->withTimestamps();
    }

    public function bons() {
        return $this->hasMany(Bon::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($equipement_stock){
            $username = auth()->user()->username;

            $equipement_stock->events()->create([
                'date' => $equipement_stock->created_at,
                'description' => "$username a créé l'équipement du stock",
            ]);
        });

        static::updated(function($equipement_stock){
            $username = auth()->user()->username;

            foreach ($equipement_stock->getChanges() as $key => $value) {
                if($key == 'designation') {
                    $old_designation = $equipement_stock->getOriginal("$key");
                    $equipement_stock->events()->create([
                        'date' => $equipement_stock->updated_at,
                        'description' => "$username a changé la désignation : $old_designation à $value",
                    ]);
                } else if($key == 'marque') {
                    $old_marque = $equipement_stock->getOriginal("$key");
                    $equipement_stock->events()->create([
                        'date' => $equipement_stock->updated_at,
                        'description' => "$username a changé la marque : $old_marque à $value",
                    ]);
                } else if($key == 'model') {
                    $old_model = $equipement_stock->getOriginal("$key");
                    $equipement_stock->events()->create([
                        'date' => $equipement_stock->updated_at,
                        'description' => "$username a changé le modèle : $old_model à $value",
                    ]);
                } else if($key == 'n_inv') {
                    $old_n_inv = $equipement_stock->getOriginal("$key");
                    if($equipement_stock->getOriginal("$key") == null) {
                        $description = "$username a ajouté un numéro d'inventaire : $value";
                    } else if($value == null) {
                        $description = "$username a supprimé le numéro d'inventaire";
                    } else {
                        $description = "$username a changé le numéro d'inventaire : $old_n_inv à $value";
                    }
                    $equipement_stock->events()->create([
                        'date' => $equipement_stock->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'quantite') {
                    $old_quantite = $equipement_stock->getOriginal("$key");
                    $equipement_stock->events()->create([
                        'date' => $equipement_stock->updated_at,
                        'description' => "$username a changé la quantité totale : $old_quantite à $value",
                    ]);
                } 
            }
        });

        static::deleting(function($equipement_stock){
            $equipement_stock->pieces()->detach();
            foreach ($equipement_stock->bons as $bon) {
                $bon->bonPieces()->delete();
                $bon->events()->delete();
            }
            $equipement_stock->bons()->delete();
            $equipement_stock->events()->delete();
        });
    }
}

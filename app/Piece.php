<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
	protected $guarded = [];
	
    public function equipementStocks() {
    	return $this->belongsToMany(EquipementStock::class)->withPivot('quantite_eq')->withTimestamps();
    }

    public function bons() {
        return $this->hasMany(Bon::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($piece){
            $username = auth()->user()->username;

            $piece->events()->create([
                'date' => $piece->created_at,
                'description' => "$username a créé la pièce du stock",
            ]);
        });

        static::updated(function($piece){
            $username = auth()->user()->username;

            foreach ($piece->getChanges() as $key => $value) {
                if($key == 'designation') {
                    $old_designation = $piece->getOriginal("$key");
                    $piece->events()->create([
                        'date' => $piece->updated_at,
                        'description' => "$username a changé la désignation : $old_designation à $value",
                    ]);
                } else if($key == 'marque') {
                    $old_marque = $piece->getOriginal("$key");
                    $piece->events()->create([
                        'date' => $piece->updated_at,
                        'description' => "$username a changé la marque : $old_marque à $value",
                    ]);
                } else if($key == 'model') {
                    $old_model = $piece->getOriginal("$key");
                    $piece->events()->create([
                        'date' => $piece->updated_at,
                        'description' => "$username a changé le modèle : $old_model à $value",
                    ]);
                } else if($key == 'n_inv') {
                    $old_n_inv = $piece->getOriginal("$key");
                    if($piece->getOriginal("$key") == null) {
                        $description = "$username a ajouté un numéro d'inventaire : $value";
                    } else if($value == null) {
                        $description = "$username a supprimé le numéro d'inventaire";
                    } else {
                        $description = "$username a changé le numéro d'inventaire : $old_n_inv à $value";
                    }
                    $piece->events()->create([
                        'date' => $piece->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'quantite') {
                    $old_quantite = $piece->getOriginal("$key");
                    $piece->events()->create([
                        'date' => $piece->updated_at,
                        'description' => "$username a changé la quantité totale : $old_quantite à $value",
                    ]);
                } 
            }
        });

        static::deleting(function($piece){
            $piece->equipementStocks()->detach();
            foreach ($piece->bons as $bon) {
                $bon->events()->delete();
            }
            $piece->bons()->delete();
            $piece->events()->delete();
        });
    }
}

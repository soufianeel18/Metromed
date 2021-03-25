<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipement extends Model
{
    protected $guarded = [];
	
    public function client() {
    	return $this->belongsTo(Client::class);
    }

    public function tickets() {
    	return $this->hasMany(Ticket::class);
    }

    public function events() {
    	return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($equipement){
            $username = auth()->user()->username;

            $equipement->events()->create([
                'date' => $equipement->created_at,
                'description' => "$username a créé l'équipement",
            ]);
        });

        static::updated(function($equipement){
            $username = auth()->user()->username;


        	foreach ($equipement->getChanges() as $key => $value) {
                if($key == 'designation') {
                    $old_designation = $equipement->getOriginal("$key");
                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => "$username a changé la désignation : $old_designation à $value",
                    ]);
                } else if($key == 'model') {
                    $old_model = $equipement->getOriginal("$key");
                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => "$username a changé le modèle : $old_model à $value",
                    ]);
                } else if($key == 'marque') {
                    $old_marque = $equipement->getOriginal("$key");
                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => "$username a changé la marque : $old_marque à $value",
                    ]);
                } else if($key == 'n_inv') {
                    $old_n_inv = $equipement->getOriginal("$key");
                    if($equipement->getOriginal("$key") == null) {
                        $description = "$username a ajouté un numéro d'inventaire : $value";
                    } else if($value == null) {
                        $description = "$username a supprimé le numéro d'inventaire";
                    } else {
                        $description = "$username a changé le numéro d'inventaire : $old_n_inv à $value";
                    }
                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'date_mise_service') {
                    $old_date_mise_service = \Carbon\Carbon::parse($equipement->getOriginal("$key"))->translatedFormat('d F Y');
                    $date_mise_service = \Carbon\Carbon::parse($value)->translatedFormat('d F Y');
                    if($equipement->getOriginal("$key") == null) {
                        $description = "$username a ajouté une date de la mise en service : $date_mise_service";
                    } else if($value == null) {
                        $description = "$username a supprimé la date de la mise en service";
                    } else {
                        $description = "$username a changé la date de la mise en service : $old_date_mise_service à $date_mise_service";
                    }
                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'fonctionnel') {
                    $old_fonctionnel = $equipement->getOriginal("$key");
                    switch ($value) {
                        case 'oui':
                            if($old_fonctionnel == 'non') {
                                $description = "L'équipement est fonctionnel, il n'était pas fonctionnel";
                            } else if($old_fonctionnel == 'anomalie') {
                                $description = "L'équipement est fonctionnel, il était fonctionnel avec anomalie";
                            }
                            break;
                        case 'anomalie':
                            if($old_fonctionnel == 'oui') {
                                $description = "L'équipement est fonctionnel avec anomalie, il était fonctionnel";
                            } else if($old_fonctionnel == 'non') {
                                $description = "L'équipement est fonctionnel avec anomalie, il n'était pas fonctionnel";
                            }
                            break;
                        case 'non':
                            if($old_fonctionnel == 'oui') {
                                $description = "L'équipement n'est pas fonctionnel, il était fonctionnel";
                            } else if($old_fonctionnel == 'anomalie') {
                                $description = "L'équipement n'est pas fonctionnel, il était fonctionnel avec anomalie";
                            }
                            break;
                    }

                    $equipement->events()->create([
                        'date' => $equipement->updated_at,
                        'description' => "$username a changé l'état : $description",
                    ]);
                }
        	}
        });

        static::deleting(function($equipement){
            foreach ($equipement->tickets as $ticket) {
                foreach ($ticket->comments as $comment) {
                    $comment->commEvents()->delete();
                }
                $ticket->comments()->delete();
                $ticket->events()->delete();
            }
            $equipement->tickets()->delete();
            $equipement->events()->delete();
        });
    }
}
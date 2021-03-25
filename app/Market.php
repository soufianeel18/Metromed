<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
	protected $guarded = [];
	
    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($market){
            $username = auth()->user()->username;

            $market->events()->create([
                'date' => $market->created_at,
                'description' => "$username a créé le marché",
            ]);
        });

        static::updated(function($market){
            $username = auth()->user()->username;


            foreach ($market->getChanges() as $key => $value) {
                if($key == 'n_market') {
                    $old_n_market = $market->getOriginal("$key");
                    $market->events()->create([
                        'date' => $market->updated_at,
                        'description' => "$username a changé le numéro du marché : $old_n_market à $value",
                    ]);
                } else if($key == 'ville') {
                    $old_ville = $market->getOriginal("$key");
                    $market->events()->create([
                        'date' => $market->updated_at,
                        'description' => "$username a changé la ville : $old_ville à $value",
                    ]);
                } 
            }
        });

        static::deleting(function($market){
            foreach ($market->clients as $client) {
                foreach ($client->equipements as $eq) {
                    foreach ($eq->tickets as $ticket) {
                        foreach ($ticket->comments as $comment) {
                            $comment->commEvents()->delete();
                        }
                        $ticket->comments()->delete();
                        $ticket->events()->delete();
                    }
                    $eq->tickets()->delete();
                    $eq->events()->delete();
                }
                $client->equipements()->delete();
                $client->events()->delete();
            }
            $market->clients()->delete();
            $market->events()->delete();
        });
    }
}

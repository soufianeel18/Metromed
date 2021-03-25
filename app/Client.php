<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $guarded = [];
	
    public function equipements() {
        return $this->hasMany(Equipement::class);
    }

    public function tickets() {
    	return $this->hasMany(Ticket::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }
    
    public function market() {
        return $this->belongsTo(Market::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($client){
            $username = auth()->user()->username;

            $client->events()->create([
                'date' => $client->created_at,
                'description' => "$username a créé le client",
            ]);
        });

        static::updated(function($client){
            $username = auth()->user()->username;


            foreach ($client->getChanges() as $key => $value) {
                if($key == 'name') {
                    $old_name = $client->getOriginal("$key");
                    $client->events()->create([
                        'date' => $client->updated_at,
                        'description' => "$username a changé le nom : $old_name à $value",
                    ]);
                } else if($key == 'phone') {
                    $old_phone = $client->getOriginal("$key");
                    $client->events()->create([
                        'date' => $client->updated_at,
                        'description' => "$username a changé le numéro de téléphone : $old_phone à $value",
                    ]);
                } 
            }
        });

        static::deleting(function($client){

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

            foreach ($client->tickets as $ticket) {
                foreach ($ticket->comments as $comment) {
                    $comment->commEvents()->delete();
                }
                $ticket->comments()->delete();
                $ticket->events()->delete();
            }
            $client->tickets()->delete();
            $client->events()->delete();
        });
    }
}

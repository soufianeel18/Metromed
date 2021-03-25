<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [];

    public function equipement() {
        return $this->belongsTo(Equipement::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function client() {
    	return $this->belongsTo(Client::class);
    }

    public function comments() {
    	return $this->hasMany(Comment::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($ticket){
            $username = auth()->user()->username;
            $date_debut = \Carbon\Carbon::parse($ticket->start_date)->translatedFormat('d F Y à H\hi');
            $date_fin = \Carbon\Carbon::parse($ticket->end_date)->translatedFormat('d F Y à H\hi');
            $titre = $ticket->title;
        
            if($ticket->equipement_id != null) {
                $type = $ticket->type;
                $nom_client = $ticket->equipement->client->name;
                $nom_technicien = $ticket->user->name;
                
                $ticket->equipement->events()->create([
                    'date' => $ticket->created_at,
                    'description' => "$username a créé un ticket :\ntitre : $titre,\nil commence le $date_debut et termine le $date_fin,\ntype $type chez $nom_client affecté à $nom_technicien",
                ]);
            } else if($ticket->client_id != null) {
                $nom_client = $ticket->client->name;
                $nom_commercial = $ticket->user->name;
                
                $ticket->client->events()->create([
                    'date' => $ticket->created_at,
                    'description' => "$username a créé un ticket :\ntitre : $titre,\nil commence le $date_debut et termine le $date_fin,\nchez $nom_client affecté à $nom_commercial",
                ]);
            }

            $ticket->events()->create([
                'date' => $ticket->created_at,
                'description' => "$username a créé le ticket",
            ]);
        });

        static::updated(function($ticket){
            $username = auth()->user()->username;

            foreach ($ticket->getChanges() as $key => $value) {
                if($key == 'user_id') {
                    $old_user_name = User::where('id', '=', $ticket->getOriginal("$key"))->first()->name;
                    $user_name = User::where('id', '=', $value)->first()->name;
                    $ticket->events()->create([
                        'date' => $ticket->updated_at,
                        'description' => "$username a retiré le ticket de $old_user_name et l'a réaffecté à $user_name",
                    ]);
                } else if($key == 'status') {
                    $old_status = $ticket->getOriginal("$key");
                    $ticket->events()->create([
                        'date' => $ticket->updated_at,
                        'description' => "$username a changé l'état : Intervention est $value, elle était $old_status",
                    ]);
                } else if($key == 'title') {
                    $old_title = $ticket->getOriginal("$key");
                    $ticket->events()->create([
                        'date' => $ticket->updated_at,
                        'description' => "$username a changé le titre : $old_title à $value",
                    ]);
                } else if($key == 'start_date') {
                    $old_date_debut = \Carbon\Carbon::parse($ticket->getOriginal("$key"))->translatedFormat('d F Y à H\hi');
                    $date_debut = \Carbon\Carbon::parse($value)->translatedFormat('d F Y à H\hi');
                    if($old_date_debut != $date_debut) {
                        $ticket->events()->create([
                            'date' => $ticket->updated_at,
                            'description' => "$username a changé la date du début : $old_date_debut à $date_debut",
                        ]);
                    }
                } else if($key == 'end_date') {
                    $old_date_fin = \Carbon\Carbon::parse($ticket->getOriginal("$key"))->translatedFormat('d F Y à H\hi');
                    $date_fin = \Carbon\Carbon::parse($value)->translatedFormat('d F Y à H\hi');
                    if($old_date_fin != $date_fin) {
                        $ticket->events()->create([
                            'date' => $ticket->updated_at,
                            'description' => "$username a changé la date de fin : $old_date_fin à $date_fin",
                        ]);
                    }
                } else if($key == 'type') {
                    $old_type = $ticket->getOriginal("$key");
                    $ticket->events()->create([
                        'date' => $ticket->updated_at,
                        'description' => "$username a changé le type : $old_type à $value",
                    ]);
                } 
            }
        });

        static::deleting(function($ticket){
            foreach ($ticket->comments as $comment) {
                $comment->commEvents()->delete();
            }
            $ticket->comments()->delete();
            $ticket->events()->delete();
        });
    }
}

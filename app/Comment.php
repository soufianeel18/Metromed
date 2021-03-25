<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
	
    public function user() {
    	return $this->belongsTo(User::class);
    }

    public function ticket() {
    	return $this->belongsTo(Ticket::class);
    }

    public function commEvents() {
    	return $this->hasMany(CommEvent::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($comment){
            $username = auth()->user()->username;
            $text = $comment->text;
            $status = "";   
            switch ($comment->fonctionnel) {
                case 'oui':
                    $status = "L'appareil est fonctionnel\n";
                    break;
                case 'anomalie':
                    $status = "L'appareil est fonctionnel avec anomalie\n";
                    break;
                case 'non':
                    $status = "L'appareil n'est pas fonctionnel\n";
                    break;
                case 'rien':
                    $status = "";
                    break;
            }

            $comment->commEvents()->create([
            	'label' => 'Original :',
                'date' => $comment->created_at,
                'text' => "$status$text",
            ]);

            $comment->ticket->events()->create([
                'date' => $comment->created_at,
                'description' => "$username a ajouté un commentaire : $status$text",
            ]);
        });

        static::updated(function($comment){
            $username = auth()->user()->username;
        	foreach ($comment->getChanges() as $key => $value) {
                if($key != 'updated_at') {
                    if($key == 'text') {
                        $text = $value;
                    } else {
                        $text = $comment->text;
                    }

                    if($key == 'fonctionnel') {
                        switch ($value) {
                            case 'oui':
                                $status = "L'appareil est fonctionnel\n";
                                break;
                            case 'anomalie':
                                $status = "L'appareil est fonctionnel avec anomalie\n";
                                break;
                            case 'non':
                                $status = "L'appareil n'est pas fonctionnel\n";
                                break;
                            case 'rien':
                                $status = "";
                                break;
                        }
                    } else {
                        $status = "";
                        switch ($comment->fonctionnel) {
                            case 'oui':
                                $status = "L'appareil est fonctionnel\n";
                                break;
                            case 'anomalie':
                                $status = "L'appareil est fonctionnel avec anomalie\n";
                                break;
                            case 'non':
                                $status = "L'appareil n'est pas fonctionnel\n";
                                break;
                            case 'rien':
                                $status = "";
                                break;
                        }
                    }
                }
            }
            $comment->commEvents()->create([
                'label' => 'Nouveau text :',
                'date' => $comment->updated_at,
                'text' => "$status$text",
            ]);

            $comment->ticket->events()->create([
                'date' => $comment->updated_at,
                'description' => "$username a modifié son commentaire : $status$text",
            ]);
        });
    }
}

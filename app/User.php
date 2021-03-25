<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'username', 'color', 'password', 'role', 'date_cnx',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tickets() {
        return $this->hasMany(Ticket::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function events() {
        return $this->hasMany(Event::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($user){
            if(auth()->user() == null) {
                $description = "L'utilisateur est créé";
            } else {
                $username = auth()->user()->username;
                $description = "$username a créé l'utilisateur";
            }

            $user->events()->create([
                'date' => $user->created_at,
                'description' => $description,
            ]);
        });

        static::updated(function($user){
            $username = auth()->user()->username;
            $username2 = $user->username;

            foreach ($user->getChanges() as $key => $value) {
                if($key == 'name') {
                    $old_name = $user->getOriginal("$key");
                    if(auth()->user()->id == $user->id) {
                        $description = "$username a changé son nom : $old_name à $value";
                    } else {
                        $description = "$username a changé le nom de $username2 : $old_name à $value";
                    }
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'email') {
                    $old_email = $user->getOriginal("$key");
                    if(auth()->user()->id == $user->id) {
                        $description = "$username a changé son adresse E-mail : $old_email à $value";
                    } else {
                        $description = "$username a changé l'adresse E-mail de $username2 : $old_email à $value";
                    }
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'phone') {
                    $old_phone = $user->getOriginal("$key");
                    if(auth()->user()->id == $user->id) {
                        $description = "$username a changé son numéro de téléphone : $old_phone à $value";
                    } else {
                        $description = "$username a changé le numéro de téléphone de $username2 : $old_phone à $value";
                    }
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'username') {
                    $old_username = $user->getOriginal("$key");
                    if(auth()->user()->id == $user->id) {
                        $description = "$username a changé son nom d'utilisateur : $old_username à $value";
                    } else {
                        $description = "$username a changé le nom d'utilisateur de $username2 : $old_username à $value";
                    }
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'password') {
                    if(auth()->user()->id == $user->id) {
                        $description = "$username a changé son mot de passe";
                    } else {
                        $description = "$username a changé le mot de passe de de $username2";
                    }
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => $description,
                    ]);
                } else if($key == 'role') {
                    $old_role = $user->getOriginal("$key");
                    $user->events()->create([
                        'date' => $user->updated_at,
                        'description' => "$username a changé le rôle de $username2 : $old_role à $value",
                    ]);
                }
            }
        });

        static::deleting(function($user){
            foreach ($user->tickets as $ticket) {
                foreach ($ticket->comments as $comment) {
                    $comment->commEvents()->delete();
                }
                $ticket->comments()->delete();
                $ticket->events()->delete();
            }
            $user->tickets()->delete();
            
            foreach ($user->comments as $comment) {
                $comment->commEvents()->delete();
            }
            $user->comments()->delete();
            $user->events()->delete();
        });
    }
}

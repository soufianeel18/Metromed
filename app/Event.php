<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function market() {
    	return $this->belongsTo(Market::class);
    }

    public function client() {
    	return $this->belongsTo(Client::class);
    }

    public function equipement() {
    	return $this->belongsTo(Equipement::class);
    }

    public function ticket() {
    	return $this->belongsTo(Ticket::class);
    }

    public function bon() {
        return $this->belongsTo(Bon::class);
    }

    public function equipementStock() {
        return $this->belongsTo(EquipementStock::class);
    }

    public function piece() {
        return $this->belongsTo(Piece::class);
    }
}

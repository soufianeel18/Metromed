<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonPiece extends Model
{
    protected $guarded = [];
	
    public function bon() {
    	return $this->belongsTo(Bon::class);
    }
}

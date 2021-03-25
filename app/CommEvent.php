<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommEvent extends Model
{
    protected $guarded = [];
	
    public function comment() {
    	return $this->belongsTo(Comment::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisTarif extends Model
{

	public $incrementing = false;

	public function coa(){
		return $this->belongsTo('App\Coa');
	}
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staf extends Model
{
	public function role(){
		return $this->belongsTo('App\Role');
	}
}

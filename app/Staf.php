<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Staf;

class Staf extends Model
{
	public function role(){
		return $this->belongsTo('App\Role');
	}
	public static function selectList(){
		return array(null => '- Pilih Staf -') + Staf::pluck('nama', 'id')->all();
	}
	
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Diagnosa;

class Diagnosa extends Model
{
	public function icd(){
		return $this->belongsTo('App\Icd');
	}
	public static function selectList(){
		return array(null => '- Pilih Diagnosa -') + Diagnosa::pluck('diagnosa', 'id')->all();
	}
	
}

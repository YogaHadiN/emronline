<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiPeriksa extends Model
{
	public function periksa(){
		return $this->belongsTo('App\Periksa');
	}
	public function jenisTarif(){
		return $this->belongsTo('App\JenisTarif');
	}
	public function asistenTindakan(){
		return $this->belongsTo('App\Staf', 'asisten_tindakan_id');
	}
}

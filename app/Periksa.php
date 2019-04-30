<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
	public function asuransi(){
		return $this->belongsTo('App\Asuransi');
	}
	public function pasien(){
		return $this->belongsTo('App\Pasien');
	}
	public function staf(){
		return $this->belongsTo('App\Staf');
	}
	public function diagnosa(){
		return $this->belongsTo('App\Diagnosa');
	}
	public function asisten(){
		return $this->belongsTo('App\Staf', 'asisten_id');
	}
	public function nurseStation(){
		return $this->belongsTo('App\NurseStation');
	}
	public function transaksiPeriksa(){
		return $this->hasMany('App\TransaksiPeriksa');
	}
}

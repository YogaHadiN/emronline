<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
	public function getPoliListAttribute(){
		
		return array(null => '- Pilih Asuransi -') + Asuransi::lists('nama', 'id')->all();

	}
}

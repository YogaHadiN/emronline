<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Obat;

class Obat extends Model
{
	public static function selectList(){
		return Obat::where('id', '>', 3)->pluck('merek', 'id')->all();
	}
}

<?php

namespace App\Observer;
use App\Asuransi;

class AsuransiObserver {

	public function creating(Asuransi $asuransi){
		dd($asuransi);
	}
	

}

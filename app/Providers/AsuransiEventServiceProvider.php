<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Session;
use App\Yoga;
use App\Tarif;

class AsuransiEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
		\App\Asuransi::creating(function ( $asuransi ){
			$asuransi->user_id = Auth::id();
		});

		\App\Asuransi::deleting(function ( $asuransi ){
			if ( Auth::id() != $asuransi->user_id ) {
				$pesan = "Maaf!! Anda tidak bisa menghapus Asuransi milik User lain!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
		});
		\App\Asuransi::updating(function ( $asuransi ){
			if ( Auth::id() != $asuransi->user_id ) {
				$pesan = "Maaf!! Anda tidak bisa mengedit Asuransi milik User lain!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
		});
		\App\Asuransi::created(function ( $asuransi ){
			$tarifs = Tarif::where('asuransi_id', 1)->get();
			$data = [];

			foreach ($tarifs as $tarif) {
				$data[] = [

				];
			}
		});
    }
}

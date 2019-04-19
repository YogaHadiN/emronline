<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PasienEventServiceProvider extends ServiceProvider
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
		\App\Pasien::deleting(function ( $asuransi ){
			if ( Auth::id() != $asuransi->user_id ) {
				$pesan = "Maaf!! Anda tidak bisa menghapus Pasien milik User lain!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
			// jika pasien sudah pernah diperiksa , gagalkan
		});
    }
}

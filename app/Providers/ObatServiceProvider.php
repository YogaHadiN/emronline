<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObatServiceProvider extends ServiceProvider
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
		\App\Obat::deleting(function ( $obat ){
			try {
				 \App\Terapi::where('obat_id', $obat->id)->firstOrFail();
				$pesan = "Maaf!! Anda tidak bisa menghapus Obat yang sudah pernah digunakan!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			} catch (\Exception $e) {
				 return true;
			}
		});
    }
}

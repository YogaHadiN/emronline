<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Session;
use App\Yoga;

class UserEventServiceProvider extends ServiceProvider
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
		\App\User::deleting(function ( $asuransi ){
			if ( Auth::id() != $asuransi->user_id ) {
				$pesan = "Maaf!! Anda tidak bisa menghapus User User lain!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
		});
		\App\User::updating(function ( $user ){

			/* dd( 'auth = ' . Auth::id() ); */
			/* dd( 'user_id = ' . $user->id ); */
			/* dd( Auth::id() == $user->id ); */
			if ( Auth::id() != $user->id ) {
				$pesan = "Maaf!! Anda tidak bisa mengedit Asuransi milik User lain!!";
				Session::flash('pesan', Yoga::gagalFlash($pesan));
				return false;
			}
		});
    }
}

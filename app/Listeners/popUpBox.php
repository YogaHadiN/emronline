<?php

namespace App\Listeners;

use App\Events\photoDetected;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class popUpBox
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  photoDetected  $event
     * @return void
     */
    public function handle(photoDetected $event)
    {
        //
    }
}

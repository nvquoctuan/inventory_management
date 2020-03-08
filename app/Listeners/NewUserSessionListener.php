<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\NewUserHasRegistedEvent;

class NewUserSessionListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserHasRegistedEvent $event)
    {
        session(['user' => $event->user['id']]);
    }
}

<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationMail;
use App\Events\NewUserHasRegistedEvent;

class ActivationNewUserListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewUserHasRegistedEvent $event)
    {
        Mail::to($event->user['email'])->send(new ActivationMail($event->user, $event->token));
    }
}

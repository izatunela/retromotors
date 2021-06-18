<?php

namespace App\Listeners;

use App\Events\UserChangeEmailEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangeEmailMail;

class SendChangeEmailListener implements ShouldQueue
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
     * @param  UserChangeEmailEvent  $event
     * @return void
     */
    public function handle(UserChangeEmailEvent $event)
    {
        Mail::to($event->new_email)->send(
            new UserChangeEmailMail($event)
        );
    }
}

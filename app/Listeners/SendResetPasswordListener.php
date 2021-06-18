<?php

namespace App\Listeners;

use App\Events\UserResetPasswordEvent;
use App\Mail\UserResetPasswordMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendResetPasswordListener implements ShouldQueue
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
     * @param  UserResetPasswordEvent  $event
     * @return void
     */
    public function handle(UserResetPasswordEvent $event)
    {
        Mail::to($event->user->email)->send(
        	new UserResetPasswordMail($event)
        );
    }
}

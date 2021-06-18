<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserChangeEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $new_email;
    public $confirmation_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($new_email,$confirmation_code)
    {
        $this->new_email = $new_email;
        $this->confirmation_code = $confirmation_code;
    }
}

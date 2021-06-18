<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class UserRegisteredEvent
{
    use Dispatchable, SerializesModels;

    public $user;
    public $confirmation_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user,$confirmation_code)
    {
        $this->user = $user;
        $this->confirmation_code = $confirmation_code;
    }
}

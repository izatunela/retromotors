<?php

namespace App\Policies;

use App\User;
use App\Models\MarketAutomobile;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketAutomobilePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can change the marketAutomobile.
     *
     * @param User $user
     * @param MarketAutomobile $marketAutomobile
     * @return mixed
     */
    public function change(User $user, MarketAutomobile $marketAutomobile)
    {
       return $marketAutomobile->user->id === $user->id;
    }

    /**
     * Determine whether the user can create marketAutomobiles.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketAutomobile.
     *
     * @param User $user
     * @param MarketAutomobile $marketAutomobile
     * @return mixed
     */
    public function delete(User $user, MarketAutomobile $marketAutomobile)
    {
        //
    }
}

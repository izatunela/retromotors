<?php

namespace App\Policies;

use App\User;
use App\MarketMotorcycle;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketMotorcyclePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can change the marketMotorcycle.
     *
     * @param User $user
     * @param MarketMotorcycle $marketMotorcycle
     * @return mixed
     */
    public function change(User $user, MarketMotorcycle $marketMotorcycle)
    {
       return $marketMotorcycle->user->id === $user->id;
    }

    /**
     * Determine whether the user can create marketMotorcycles.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketMotorcycle.
     *
     * @param User $user
     * @param MarketMotorcycle $marketMotorcycle
     * @return mixed
     */
    public function delete(User $user, MarketMotorcycle $marketMotorcycle)
    {
        //
    }
}

<?php

namespace App\Policies;

use App\User;
use App\MarketTruck;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketTruckPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can change the marketTruck.
     *
     * @param User $user
     * @param MarketTruck $marketTruck
     * @return mixed
     */
    public function change(User $user, MarketTruck $marketTruck)
    {
       return $marketTruck->user->id === $user->id;
    }

    /**
     * Determine whether the user can create marketTrucks.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketTruck.
     *
     * @param User $user
     * @param MarketTruck $marketTruck
     * @return mixed
     */
    public function delete(User $user, MarketTruck $marketTruck)
    {
        //
    }
}

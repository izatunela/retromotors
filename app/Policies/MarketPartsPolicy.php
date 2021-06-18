<?php

namespace App\Policies;

use App\User;
use App\MarketParts;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketPartsPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can change the marketParts.
     *
     * @param User $user
     * @param MarketParts $marketParts
     * @return mixed
     */
    public function change(User $user, MarketParts $marketParts)
     {
       return $marketParts->user->id === $user->id;
     }


    /**
     * Determine whether the user can create marketParts.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketParts.
     *
     * @param User $user
     * @param MarketParts $marketParts
     * @return mixed
     */
    public function delete(User $user, MarketParts $marketParts)
    {
        //
    }
}

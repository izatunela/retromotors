<?php

namespace App\Policies;

use App\User;
use App\MarketEquipment;
use Illuminate\Auth\Access\HandlesAuthorization;

class MarketEquipmentPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
    /**
     * Determine whether the user can change the marketEquipment.
     *
     * @param User $user
     * @param MarketEquipment $marketEquipment
     * @return mixed
     */
    public function change(User $user, MarketEquipment $marketEquipment)
     {
       return $marketEquipment->user->id === $user->id;
     }

    /**
     * Determine whether the user can create marketEquipments.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the marketEquipment.
     *
     * @param User $user
     * @param MarketEquipment $marketEquipment
     * @return mixed
     */
    public function delete(User $user, MarketEquipment $marketEquipment)
    {
        //
    }
}

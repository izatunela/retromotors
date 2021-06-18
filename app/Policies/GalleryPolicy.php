<?php

namespace App\Policies;

use App\User;
use App\Gallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class GalleryPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can change the gallery.
     *
     * @param User $user
     * @param Gallery $gallery
     * @return mixed
     */
    public function change(User $user,  $item)
    {
       return $item->user->id === $user->id;
    }

    /**
     * Determine whether the user can create galleries.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the gallery.
     *
     * @param User $user
     * @param Gallery $gallery
     * @return mixed
     */
    // public function update(User $user, Gallery $gallery)
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the gallery.
     *
     * @param User $user
     * @param Gallery $gallery
     * @return mixed
     */
    public function delete(User $user, Gallery $gallery)
    {
        //
    }
}

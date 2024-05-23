<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collection;

class CollectionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Collection $collection)
    {
        return $user->collections->contains($collection);
        //  return $collection->users->contains($user);
    }

    public function update(User $user, Collection $collection)
    {
        return $user->collections->contains($collection);
    }

    public function delete(User $user, Collection $collection)
    {
        return $user->collections->contains($collection);
    }
}

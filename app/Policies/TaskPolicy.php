<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collection;
use App\Models\Task;


class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }



    public function create(User $user, Collection $collection)
    {
        // return $task->collection->users->contains($user);
        return $collection->users->contains($user);
    }


    public function update(User $user, Task $task)
    {
        // return $task->collection->users->contains($user);
         return $collection->users->contains($user);
    }

    public function delete(User $user, Task $task)
    {
         return $collection->users->contains($user);
    }
     public function view(User $user, Task $task)
    {
         return $collection->users->contains($user);
    }
}

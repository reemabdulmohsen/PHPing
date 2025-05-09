<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */


    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Task $task): bool
    {
        if ($user->id === $task->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Task $task): bool
    {
        if ($user->id === $task->user_id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Task $task): bool
    {
        if ($user->id === $task->user_id) {
            return true;
        }
        return false;
    }
}

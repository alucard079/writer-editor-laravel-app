<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any users.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can view the specific user.
     */
    public function view(User $user, User $model): bool
    {
        // Editors can view any user; Writers can only view themselves
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can create a user.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can update the specific user.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can delete the specific user.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can restore the specific user.
     */
    public function restore(User $user, User $model): bool
    {
        return $user->hasRole('editor');
    }

    /**
     * Determine whether the user can permanently delete the specific user.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return $user->hasRole('editor');
    }
}
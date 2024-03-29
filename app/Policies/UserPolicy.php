<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }

    public function viewPartners(User $user): bool
    {
        return in_array($user->role->slug, Role::slugsInArray('admin'));
    }

    public function viewCategories(User $user): bool
    {
        return in_array($user->role->slug, Role::slugsInArray('admin'));
    }

    public function viewProductCategories(User $user): bool
    {
        return in_array($user->role->slug, Role::slugsInArray('admin'));
    }

    public function viewCities(User $user): bool
    {
        return in_array($user->role->slug, Role::slugsInArray('admin'));
    }
}

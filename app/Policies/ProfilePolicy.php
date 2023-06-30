<?php

namespace App\Policies;

use App\Http\Livewire\Auth\Pages\Profile as PagesProfile;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role->slug, Role::slugsInArray('user'));
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profile $profile): bool
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
    public function update(User $user, Profile $profile): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Profile $profile): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Profile $profile): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Profile $profile): bool
    {
        //
    }

    public function approvable(User $user, Profile $profile): bool
    {
        $profile_component = new PagesProfile;
        $has_empty_values  = collect($profile_component->form)
            ->keys()
            ->filter(function ($key) use ($profile_component) {
                return $profile_component->required('form.' . $key);
            })
            ->filter(function ($field) use ($profile) {
                return empty($profile->$field);
            })
            ->isNotEmpty();

        return in_array($user->role->slug, Role::slugsInArray('admin')) && !$profile->approved && !$profile->qr_code && !$has_empty_values;
    }

    public function qrCode(User $user, Profile $profile): bool
    {
        return $profile->approved && $profile->qr_code;
    }
}

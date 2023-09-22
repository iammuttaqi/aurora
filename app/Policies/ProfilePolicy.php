<?php

namespace App\Policies;

use App\Http\Livewire\Auth\Pages\Profile\Index;
use App\Models\Package;
use App\Models\Product;
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
        $profile_component = new Index;
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

    public function canSell(User $user): bool
    {
        $product_ids = session('product_ids');

        $my_profile = Profile::where('user_id', $user->id)
            ->with('profile_packages.package')
            ->first();
        $my_sold_products_count = Product::query()
            ->where('profile_id', '!=', auth()->user()->profile->id)
            ->whereHas('product_profiles', function ($query) {
                $query->where('profile_id', auth()->user()->profile->id);
            })
            ->latest()
            ->count();
        $package_free_product_count = Package::where('price', 0)->value('products_count');
        $package_total_products_count = $my_profile->profile_packages->sum(function ($package) {
            return $package->package->products_count;
        });

        return ($my_sold_products_count + count($product_ids)) <= ($package_free_product_count + $package_total_products_count);
    }
}

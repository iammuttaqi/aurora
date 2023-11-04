<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role->type == 'user' && $user->profile && $user->profile->approved && $user->profile->qr_code;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role->slug == 'manufacturer';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->role->slug == 'manufacturer';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role->slug == 'manufacturer' && $product->profile_id == $user->profile->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Product $product): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        //
    }

    public function duplicate(User $user, Product $product): bool
    {
        return $user->role->slug == 'manufacturer' && $product->profile_id == $user->profile->id;
    }

    public function checkable(User $user, Product $product): bool
    {
        return !session('product_ids') || (is_array(session('product_ids')) && !in_array($product->id, session('product_ids')));
    }

    public function sell(User $user): bool
    {
        return $user->role->type == 'user';
    }

    public function viewProductBox(User $user): bool
    {
        return $user->role->type == 'user' && is_array(session('product_ids')) && count(session('product_ids'));
    }

    public function canSellToBoth(User $user): bool
    {
        return $user->role->slug == 'shop';
    }
}

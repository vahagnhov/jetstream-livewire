<?php

namespace App\Policies;

use App\Constants\Permission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{

    use HandlesAuthorization;

    /**
     * @param User|null $user
     * @return bool
     */
    public function index(?User $user)
    {
        // Check if the customer has the "view products" permission
        return $user->hasPermissionTo(Permission::VIEW_PRODUCTS);
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function show(?User $user)
    {
        // Check if the customer has the "choose product" permission
        return $user->hasPermissionTo(Permission::SELECT_PRODUCT);
    }

    /**
     * @param User|null $user
     * @return bool
     */
    public function purchase(?User $user)
    {
        // Check if the customer has the "purchase product" permission
        return $user->hasPermissionTo(Permission::PURCHASE_PRODUCT);
    }

}

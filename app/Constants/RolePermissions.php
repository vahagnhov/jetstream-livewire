<?php

namespace App\Constants;

use App\Constants\Permission;

class RolePermissions
{
    const ADMIN_PERMISSIONS = [
        Permission::VIEW_ADMIN_DASHBOARD,
        Permission::LIST_USERS,
        Permission::CANCEL_USER_VIEW_PRODUCTS_ACCESS,
        Permission::CANCEL_USER_SELECT_PRODUCT_ACCESS,
        Permission::CANCEL_USER_PURCHASE_PRODUCT_ACCESS,
        Permission::CANCEL_USER_CANCEL_PURCHASE_ACCESS,
    ];

    const CUSTOMER_PERMISSIONS = [
        Permission::VIEW_DASHBOARD,
        Permission::VIEW_PRODUCTS,
        Permission::SELECT_PRODUCT,
        Permission::PURCHASE_PRODUCT,
        Permission::CANCEL_PURCHASE,
    ];
}

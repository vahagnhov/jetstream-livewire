<?php

namespace Database\Seeders;

use App\Constants\RolePermissions;
use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Merge the two permissions arrays
        $permissionValues = array_merge(RolePermissions::ADMIN_PERMISSIONS, RolePermissions::CUSTOMER_PERMISSIONS);

        foreach ($permissionValues as $permissionValue) {
            $permission = Permission::make(['name' => $permissionValue]);
            $permission->saveOrFail();
        }

        // Find roles and assign permissions
        $adminRole = Role::findByName(Roles::ADMIN);
        $adminRole->givePermissionTo(RolePermissions::ADMIN_PERMISSIONS);

        $b2cCustomerRole = Role::findByName(Roles::B2C_CUSTOMER);
        $b2cCustomerRole->givePermissionTo(RolePermissions::CUSTOMER_PERMISSIONS);

        $b2bCustomerRole = Role::findByName(Roles::B2B_CUSTOMER);
        $b2bCustomerRole->givePermissionTo(RolePermissions::CUSTOMER_PERMISSIONS);
    }
}

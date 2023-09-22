<?php

namespace Database\Seeders;

use App\Constants\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            Roles::ADMIN,
            Roles::B2C_CUSTOMER,
            Roles::B2B_CUSTOMER,
        ];

        foreach ($roles as $role) {
            $permission = Role::make(['name' => $role]);
            $permission->saveOrFail();
        }
    }
}

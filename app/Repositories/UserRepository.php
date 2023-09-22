<?php

namespace App\Repositories;

use App\Constants\Roles;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param Request $request
     * @param string $type
     * @return bool
     */
    public function assignUserRole(Request $request, string $type): bool
    {
        $role = ($type === 'B2B') ? Roles::B2B_CUSTOMER : Roles::B2C_CUSTOMER;
        $request->user()->assignRole($role);
        return true;
    }
}

<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    /**
     * @param Request $request
     * @param string $type
     * @return mixed
     */
    public function assignUserRole(Request $request, string $type): mixed;
}

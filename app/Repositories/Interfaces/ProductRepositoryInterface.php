<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getProducts(): mixed;

    /**
     * @param int $id
     * @return mixed
     */
    public function findData(int $id): mixed;
}

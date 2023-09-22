<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @return mixed
     */
    public function getProducts(): mixed
    {
        $products = Product::get();
        return $products;
    }


    /**
     * @param int $id
     * @return mixed
     */
    public function findData(int $id): mixed
    {
        $product = Product::findOrFail($id);
        return $product;
    }
}

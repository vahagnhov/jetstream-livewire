<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productsValues = [
            [
                'name' => 'Product 1',
                'slug' => 'product_1',
                'stripe_product' => config('services.stripe.products.product_price_1'),
                'price' => 0.01,
                'description' => 'Product 1 description',
                'product_type' => 'B2B'
            ],
            [
                'name' => 'Product 2',
                'slug' => 'product_2',
                'stripe_product' => config('services.stripe.products.product_price_2'),
                'price' => 0.02,
                'description' => 'Product 2 description',
                'product_type' => 'B2C'
            ]
        ];

        foreach ($productsValues as $productsValue) {
            Product::create($productsValue);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Band T-Shirt Black',
                'description' => 'Official Band T-Shirt in Black. 100% Cotton.',
                'price' => 150000,
                'image' => 'https://placehold.co/400x400/000000/FFFFFF/png?text=Band+T-Shirt',
                'variants' => [
                    ['size' => 'S', 'stock' => 10],
                    ['size' => 'M', 'stock' => 20],
                    ['size' => 'L', 'stock' => 15],
                    ['size' => 'XL', 'stock' => 5],
                ]
            ],
            [
                'name' => 'Band Hoodie',
                'description' => 'Warm and cozy hoodie with band logo.',
                'price' => 350000,
                'image' => 'https://placehold.co/400x400/333333/FFFFFF/png?text=Band+Hoodie',
                'variants' => [
                    ['size' => 'M', 'stock' => 10],
                    ['size' => 'L', 'stock' => 10],
                ]
            ],
            [
                'name' => 'Tour Poster 2026',
                'description' => 'Limited edition tour poster.',
                'price' => 50000,
                'image' => 'https://placehold.co/400x400/FFFFFF/000000/png?text=Poster',
                'variants' => [
                    ['size' => 'A3', 'stock' => 100],
                ]
            ],
        ];

        foreach ($products as $data) {
            $variants = $data['variants'];
            unset($data['variants']);
            $data['slug'] = Str::slug($data['name']);
            
            $product = Product::create($data);

            foreach ($variants as $variant) {
                $product->variants()->create($variant);
            }
        }
    }
}

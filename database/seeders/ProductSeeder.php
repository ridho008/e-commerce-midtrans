<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Jas Hitam',
                'description' => 'Kiersten White',
                'qty' => 100,
                'price' => 300000,
                'image' => 'https://source.unsplash.com/random/featured/?sewing',
            ],
            [
                'name' => 'Slayer Wesing',
                'description' => 'Kiersten White',
                'qty' => 100,
                'price' => 100000,
                'image' => 'https://source.unsplash.com/random/featured/?sewing',
            ],
            [
                'name' => 'Kemeja Hitam',
                'description' => 'Kiersten White',
                'qty' => 100,
                'price' => 200000,
                'image' => 'https://source.unsplash.com/random/featured/?sewing',
            ],
        ];
        foreach ($products as $key => $value) {
            Products::create($value);
        }
    }
}

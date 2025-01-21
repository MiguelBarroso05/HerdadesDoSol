<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'description' => 'Description for product 1',
                'category_id' => 1,
                'estate_id' => 2,
                'price' => 100,
                'stock' => 10
            ]
        ]);
        DB::table('products')->insert([
            [
                'name' => 'Product 2',
                'description' => 'Description for product 2',
                'category_id' => 2,
                'estate_id' => 1,
                'price' => 200,
                'stock' => 20
            ]
        ]);
        DB::table('products')->insert([
            [
                'name' => 'Product 3',
                'description' => 'Description for product 3',
                'category_id' => 3,
                'estate_id' => 3,
                'price' => 300,
                'stock' => 30
            ]
        ]);
    }
}

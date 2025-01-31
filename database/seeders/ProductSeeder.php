<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Criar categorias
        $categories = [
            'Wines & Beverages',
            'Olive Oils & Preserves',
            'Honey & Derivatives',
            'Cork & Crafts',
            'Natural Cosmetics',
            'Decor & Lifestyle'
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(['name' => $category]);
        }

        // Criar produtos com distribuição controlada
        Product::factory()
            ->count(100)
            ->sequence(fn ($sequence) => [
                'category_id' => $this->getCategoryId($sequence->index)
            ])
            ->create();
    }

    private function getCategoryId($index)
    {
        return match(true) {
            $index < 25 => Category::where('name', 'Wines & Beverages')->first()->id,
            $index < 45 => Category::where('name', 'Olive Oils & Preserves')->first()->id,
            $index < 60 => Category::where('name', 'Honey & Derivatives')->first()->id,
            $index < 75 => Category::where('name', 'Cork & Crafts')->first()->id,
            $index < 90 => Category::where('name', 'Natural Cosmetics')->first()->id,
            default => Category::where('name', 'Decor & Lifestyle')->first()->id,
        };
    }
}
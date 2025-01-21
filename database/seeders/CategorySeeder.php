<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     DB::table('categories')->insert([
        'name' => 'Fruits',

     ]);
     DB::table('categories')->insert([
        'name' => 'Vegetables',
     ]);
     DB::table('categories')->insert([
        'name' => 'Meat',
     ]);
    }
}

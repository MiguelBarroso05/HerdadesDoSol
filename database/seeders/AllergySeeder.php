<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllergySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('allergies')->insert([
            ['name' => 'Pólen'],
            ['name' => 'Lactose'],
            ['name' => 'Frutos secos']
        ]);
    }
}

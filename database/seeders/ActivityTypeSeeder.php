<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activity_types')->insert([
            ['name' => 'Outdoor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Indoor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Adventure', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Nocturne', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Aquatic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Routes', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }
}

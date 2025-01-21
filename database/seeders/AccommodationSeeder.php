<?php

namespace Database\Seeders;

use App\Models\accommodation\Accommodation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accommodations')->insert([
            [
                'size' => 2,
                'accommodation_type_id' => 1,
                'description' => 'Compact tent perfect for camping.',
                'img' => '1_Tent.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 2,
                'description' => 'Cozy bungalow ideal for family vacations.',
                'img' => '2_Bungalow.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 6,
                'accommodation_type_id' => 3,
                'description' => 'Spacious cabin with forest views.',
                'img' => 'cabin.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        Accommodation::factory(5)->create();
    }
}

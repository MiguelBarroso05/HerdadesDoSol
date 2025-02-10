<?php

namespace Database\Seeders;

use App\Models\accommodation\AccommodationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccommodationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accommodation_types')->insert([
            ['name' => 'Tent', 'img' => 'accommodation_type/1_Tent.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bungalow', 'img' => 'accommodation_type/2_Bungalow.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cabin', 'img' => 'accommodation_type/3_Cabin.png', 'created_at' => now(), 'updated_at' => now()],
        ]);
        //AccommodationType::factory(3)->create();
    }
}

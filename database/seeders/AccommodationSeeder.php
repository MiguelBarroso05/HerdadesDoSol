<?php

namespace Database\Seeders;

use App\Models\accommodation\Accommodation;
use App\Models\Estate;
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
                'accommodation_type_id' => 2,
                'estate_id' => 1,
                'name' => 'Bungalow for 2',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 2,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 2',
                'price' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 2,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 2',
                'price' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 2,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 2',
                'price' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 4',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 4',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 2,
                'estate_id' => 1,
                'name' => 'Bungalow for 4',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 2,
                'estate_id' => 2,
                'name' => 'Bungalow for 4',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 4,
                'accommodation_type_id' => 2,
                'estate_id' => 2,
                'name' => 'Bungalow for 4',
                'price' => 100,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 6,
                'accommodation_type_id' => 1,
                'estate_id' => 1,
                'name' => 'Tent for 6',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 6,
                'accommodation_type_id' => 3,
                'estate_id' => 1,
                'name' => 'Cabin for 6',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'size' => 6,
                'accommodation_type_id' => 3,
                'estate_id' => 3,
                'name' => 'Cabin for 6',
                'price' => 200,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        Accommodation::factory(20)->create();

    }
}

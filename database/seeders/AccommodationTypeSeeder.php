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
            ['name' => 'Tent', 'img' => 'accommodation_type/1_Tents.jpg',
                'description' => 'Experience the outdoors like never before! Our comfortable tents provide a unique way to connect with nature, offering a cozy retreat under the stars while ensuring essential amenities for a pleasant stay.',
                'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bungalow', 'img' => 'accommodation_type/2_Bungalow.jpg',
                'description' => 'A perfect balance between comfort and nature. Our bungalows offer a private and cozy space with all the necessary amenities, making them ideal for a relaxing getaway amidst beautiful landscapes.',
                'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cabin', 'img' => 'accommodation_type/3_Cabins.jpg',
                'description' => 'Escape to a rustic yet charming cabin, surrounded by nature. Equipped with modern comforts, our cabins provide a peaceful and warm atmosphere, perfect for unwinding and enjoying scenic views.',
                'created_at' => now(), 'updated_at' => now()],
        ]);
        //AccommodationType::factory(3)->create();
    }
}

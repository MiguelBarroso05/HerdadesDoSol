<?php

namespace Database\Seeders;

use App\Models\activity\Activity;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('activities')->insert([
            [
                'activity_type_id' => 1,
                'name' => 'Hiking',
                'description' => 'Explore beautiful trails',
                'img' => '/activities/1_Hiking.jpg',
                'estate_id' => 1,
                'price' => 50.00,
                'max_participants' => 10,
                'participants' => 0,
                'adult_activity' => true,
                'date' => '2025-01-28',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity_type_id' => 2,
                'name' => 'Cooking Class',
                'description' => 'Learn to cook amazing dishes',
                'img' => '/activities/2_CookingClass.jpg',
                'estate_id' => 2,
                'price' => 40.00,
                'max_participants' => 10,
                'participants' => 0,
                'adult_activity' => false,
                'date' => '2025-01-28',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity_type_id' => 3,
                'name' => 'Rock Climbing',
                'description' => 'Challenge yourself on rock walls',
                'img' => '/activities/3_RockClimbing.jpg',
                'estate_id' => 3,
                'price' => 60.00,
                'max_participants' => 30,
                'participants' => 28,
                'adult_activity' => false,
                'date' => '2025-01-28',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        Activity::factory(6)->create();
    }
}

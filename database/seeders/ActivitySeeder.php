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
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity_type_id' => 2,
                'name' => 'Cooking Class',
                'description' => 'Learn to cook amazing dishes',
                'img' => '/activities/2_CookingClass.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'activity_type_id' => 3,
                'name' => 'Rock Climbing',
                'description' => 'Challenge yourself on rock walls',
                'img' => '/activities/3_RockClimbing.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        Activity::factory(6)->create();
    }
}

<?php

namespace Database\Factories\activity;

use App\Models\activity\ActivityType;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\activity\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'activity_type_id' => ActivityType::factory(),
            'name' => $this->faker->words(3, true),
            'estate_id' => $this->faker->numberBetween(1, 4),
            'price' => $this->faker->numberBetween(10, 100),
            'max_participants' => $this->faker->numberBetween(10, 30),
            'participants' => $this->faker->numberBetween(0, 30),
            'adult_activity' => $this->faker->boolean(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'duration' => $this->faker->numberBetween(30, 120),
            
            'description' => $this->faker->sentence(15),
            'img' => null,
        ];
    }
}

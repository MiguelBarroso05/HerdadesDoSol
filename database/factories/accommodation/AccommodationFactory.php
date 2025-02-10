<?php

namespace Database\Factories\accommodation;

use App\Models\accommodation\AccommodationType;
use App\Models\Estate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\accommodation\Accommodation>
 */
class AccommodationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $accommodationTypes = AccommodationType::all();
        return [
            'accommodation_type_id' => $accommodationTypes->random()->id,
            'estate_id' => $this->faker->numberBetween(1, 4),
            'name' => $this->faker->name(),
            'size' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->numberBetween(50, 200),
        ];
    }
}

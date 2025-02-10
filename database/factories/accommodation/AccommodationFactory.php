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
        $type = $accommodationTypes->random();
        $size = $this->faker->numberBetween(1, 6);

        return [
            'accommodation_type_id' => $type->id,
            'estate_id' => $this->faker->numberBetween(1, 4),
            'name' => "{$type->name} for {$size}",
            'size' => $size,
            'price' => $this->faker->numberBetween(50, 200),
        ];
    }
}

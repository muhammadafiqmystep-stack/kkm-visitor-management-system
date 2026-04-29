<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $malaysianModels = [
            'Perodua Myvi',
            'Perodua Bezza',
            'Perodua Axia',
            'Proton Saga',
            'Proton Persona',
            'Proton X50',
            'Honda City',
            'Toyota Vios',
        ];
        return [
            'modelName' => fake()->randomElement($malaysianModels),
            // Common MY-style example: "WAB1234" / "BKT9876"
            'plateNumber' => fake()->unique()->regexify('[A-Z]{1,3}[0-9]{1,4}'),
            'color' => fake()->safeColorName(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'phone' => fake()->e164PhoneNumber(),
            'email' => fake()->safeEmail(),
            'address' => [
                'line' => fake()->streetAddress(),
                'city' => fake()->city(),
                'state' => fake()->stateAbbr(),
                'country' => 'USA',
                'zipCode' => fake()->postcode()
            ],
            'lat' => 43.546,
            'lng' => -96.73,
        ];
    }
}

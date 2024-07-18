<?php

namespace Database\Factories;

use App\Models\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuItem>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => MenuCategory::factory(),
            'name' => fake()->sentence(3, false),
            'description' => fake()->paragraph(),
            'short_description' => fake()->sentence(7, false),
            'price' => fake()->randomNumber(4, true),
            'image_url' => '/images/item.jpeg',
            'featured' => fake()->randomElement([0, 1]),
        ];
    }
}

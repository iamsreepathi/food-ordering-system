<?php

namespace Database\Factories;

use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MenuRating>
 */
class MenuRatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'menu_item_id' => MenuItem::factory(),
            'rating' => fake()->randomElement([1, 2, 3, 4, 5]),
            'review' => fake()->paragraph()
        ];
    }
}

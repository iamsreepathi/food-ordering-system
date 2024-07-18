<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\MenuRating;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        // $users = User::where('id', 1)->get();
        // $items = MenuItem::where('id', 1)->get();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $categories = MenuCategory::factory(10)->create();

        // $items = MenuItem::factory(50)->recycle($categories)->create();

        // MenuRating::factory(20)->recycle($users)->recycle($items)->create();

        Location::factory(1)->create();
    }
}

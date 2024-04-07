<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory(10)->create();

        Category::factory()->create([
            'name' => 'News',
        ]);

        Category::factory()->create([
            'name' => 'Announcements',
        ]);

        Category::factory()->create([
            'name' => 'Events',
        ]);
    }
}

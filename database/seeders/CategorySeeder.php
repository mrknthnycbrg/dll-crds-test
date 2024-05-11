<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Category::factory()->create([
            'name' => 'Announcements',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Category::factory()->create([
            'name' => 'Events',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);
    }
}

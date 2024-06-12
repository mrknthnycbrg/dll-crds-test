<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Author::factory(5)->create();

        Author::factory()->create([
            'name' => 'College Research and Development Services',
        ]);

        Author::factory()->create([
            'name' => 'The Dalubcenian Publication',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\YearSection;
use Illuminate\Database\Seeder;

class YearSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // YearSection::factory(5)->create();

        YearSection::factory()->create([
            'name' => '4A',
        ]);

        YearSection::factory()->create([
            'name' => '4B',
        ]);

        YearSection::factory()->create([
            'name' => '4C',
        ]);

        YearSection::factory()->create([
            'name' => '4D',
        ]);

        YearSection::factory()->create([
            'name' => '4E',
        ]);
    }
}

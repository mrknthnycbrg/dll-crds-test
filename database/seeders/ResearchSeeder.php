<?php

namespace Database\Seeders;

use App\Models\Research;
use Illuminate\Database\Seeder;

class ResearchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Research::factory(100)->create();
    }
}

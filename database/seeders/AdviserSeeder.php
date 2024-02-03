<?php

namespace Database\Seeders;

use App\Models\Adviser;
use Illuminate\Database\Seeder;

class AdviserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Adviser::factory(20)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Downloadable;
use Illuminate\Database\Seeder;

class DownloadableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Downloadable::factory(20)->create();
    }
}

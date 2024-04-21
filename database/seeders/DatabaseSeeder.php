<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ShieldSeeder::class,
            DepartmentSeeder::class,
            YearSectionSeeder::class,
            // AdviserSeeder::class,
            CategorySeeder::class,
            // NumberSeeder::class,
            // ResearchSeeder::class,
            // PostSeeder::class,
            // DownloadableSeeder::class,
        ]);
    }
}

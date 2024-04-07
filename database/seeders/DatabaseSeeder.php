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
            AdviserSeeder::class,
            AwardSeeder::class,
            CategorySeeder::class,
            DepartmentSeeder::class,
            DownloadableSeeder::class,
            NumberSeeder::class,
            PostSeeder::class,
            ResearchSeeder::class,
            ShieldSeeder::class,
            UserSeeder::class,
        ]);
    }
}

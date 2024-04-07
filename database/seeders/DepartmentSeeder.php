<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Department::factory(8)->create();

        Department::factory()->create([
            'name' => 'Bachelor of Arts in English Language Studies',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'ABELS',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accountancy',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSA',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accounting Information System',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSAIS',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Entrepreneurship',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSE',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Information Technology',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSIT',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Public Administration',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSPA',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Social Work',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BSSW',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Technical Vocational Teachers Education',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'abbreviation' => 'BTVTEd',
        ]);
    }
}

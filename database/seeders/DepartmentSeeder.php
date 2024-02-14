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
            'name' => 'Bachelor of Arts in English Language Studies (ABELS)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accountancy (BSA)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accounting Information System (BSAIS)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Entrepreneurship (BSE)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Information Technology (BSIT)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Public Administration (BSPA)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Social Work (BSSW)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Technical Vocational Teachers Education (BTVTE)',
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
        ]);
    }
}

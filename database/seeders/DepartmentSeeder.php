<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

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
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accountancy (BSA)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Accounting Information System (BSAIS)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Entrepreneurship (BSE)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Information Technology (BSIT)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Public Administration (BSPA)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Science in Social Work (BSSW)',
        ]);

        Department::factory()->create([
            'name' => 'Bachelor of Technical Vocational Teachers Education (BTVTE)',
        ]);
    }
}

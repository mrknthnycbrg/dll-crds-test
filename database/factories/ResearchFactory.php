<?php

namespace Database\Factories;

use App\Models\Adviser;
use App\Models\Award;
use App\Models\Department;
use App\Models\Research;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Research>
 */
class ResearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Research::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->realText(200),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title']);
            },
            'author' => $this->faker->unique()->name(),
            'keyword' => $this->faker->words(3, true),
            'file_path' => null,
            'abstract' => $this->faker->unique()->realText(2000),
            'department_id' => function () {
                return Department::inRandomOrder()->first()->id;
            },
            'adviser_id' => function () {
                return Adviser::inRandomOrder()->first()->id;
            },
            'award_id' => function () {
                return Award::inRandomOrder()->first()->id;
            },
            'published' => true,
            'date_submitted' => $this->faker->dateTimeBetween('-4 years'),
        ];
    }
}

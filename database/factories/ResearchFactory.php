<?php

namespace Database\Factories;

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
            'title' => $title = $this->faker->unique()->realText(200),
            'slug' => Str::slug($title),
            'author' => $this->faker->unique()->name(),
            'keyword' => $this->faker->words(3, true),
            'file_path' => null,
            'image_path' => null,
            'abstract' => $this->faker->unique()->realText(2000),
            'department_id' => $this->faker->numberBetween(1, 8),
            'adviser_id' => $this->faker->numberBetween(1, 5),
            'published' => true,
            'date_submitted' => $this->faker->dateTimeBetween('-4 years'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Downloadable;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Downloadable>
 */
class DownloadableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Downloadable::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->realText(50),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['name']);
            },
            'file_path' => null,
            'description' => $this->faker->unique()->realText(500),
            'published' => true,
            'date_published' => $this->faker->dateTimeBetween('-4 years'),
        ];
    }
}

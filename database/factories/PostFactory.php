<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->realText(100),
            'slug' => function (array $attributes) {
                return Str::slug($attributes['title']);
            },
            'image_path' => null,
            'content' => $this->faker->unique()->realText(1000),
            'category_id' => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'published' => true,
            'date_published' => $this->faker->dateTimeBetween('-4 years'),
        ];
    }
}

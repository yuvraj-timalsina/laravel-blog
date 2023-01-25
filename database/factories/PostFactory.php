<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'featured_image' => '/blogs/blog-'. $this->faker->numberBetween(1, 9) .'.jpg',
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
        ];
    }
}

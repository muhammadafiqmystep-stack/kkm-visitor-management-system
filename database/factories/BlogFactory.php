<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genres = [
            'Technology',
            'Business',
            'Lifestyle',
            'Travel',
            'Education',
            'Health',
            'Food',
            'Sports',
        ];

        return [
            'title' => fake()->sentence(5),
            'description' => fake()->paragraphs(3, true),
            'author' => fake()->name(),
            'genre' => fake()->randomElement($genres),
        ];
    }
}

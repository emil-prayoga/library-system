<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'year' => fake()->numberBetween(1950, 2024),
            'stock' => fake()->numberBetween(1, 10),
            'category' => fake()->randomElement(['Fiction', 'Non-Fiction', 'Science', 'History', 'Technology', 'Fantasy']),
        ];
    }
}
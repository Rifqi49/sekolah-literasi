<?php

namespace Database\Factories;

use App\Models\BookCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(
            fake()->numberBetween(2, 6)
        );

        return [
            'category_id' => BookCategory::factory(),

            'title' => ucfirst(
                rtrim($title, '.')
            ),

            'slug' => Str::slug($title),

            'description' => fake()->paragraphs(
                fake()->numberBetween(2, 4),
                true
            ),

            'isbn' => fake()->numerify('978-##########'),

            'publisher' => fake()->company(),

            'publication_year' => fake()->numberBetween(
                2018,
                2026
            ),

            'cover' => null,

            'file' => null,

            'status' => fake()->randomElement([
                'draft',
                'published',
                'published',
                'published',
                'archived',
            ]),

            'views' => fake()->numberBetween(0, 5000),

            'published_at' => fake()->optional(
                0.8
            )->dateTimeBetween(
                '-2 years',
                'now'
            ),
        ];
    }

    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'published',
            'published_at' => now(),
        ]);
    }
}
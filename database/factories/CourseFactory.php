<?php

namespace Database\Factories;

use App\Models\CourseCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(
            fake()->numberBetween(3, 7)
        );

        return [
            'category_id' => CourseCategory::factory(),

            'title' => ucfirst(
                rtrim($title, '.')
            ),

            'slug' => Str::slug($title),

            'description' => fake()->paragraphs(
                fake()->numberBetween(2, 4),
                true
            ),

            'thumbnail' => null,

            'instructor' => fake()->name(),

            'level' => fake()->randomElement([
                'beginner',
                'intermediate',
                'advanced',
            ]),

            'duration' => fake()->numberBetween(
                30,
                300
            ),

            'status' => fake()->randomElement([
                'draft',
                'published',
                'published',
                'published',
                'archived',
            ]),

            'published_at' => fake()->optional(
                0.8
            )->dateTimeBetween(
                '-1 year',
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
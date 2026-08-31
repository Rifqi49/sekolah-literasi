<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(
            fake()->numberBetween(3, 7)
        );

        return [
            'course_id' => Course::factory(),

            'title' => ucfirst(
                rtrim($title, '.')
            ),

            'slug' => Str::slug($title),

            'description' => fake()->sentence(),

            'content' => fake()->paragraphs(
                fake()->numberBetween(4, 8),
                true
            ),

            'video_url' => fake()->optional(
                0.5
            )->randomElement([
                'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'https://www.youtube.com/watch?v=example',
            ]),

            'attachment' => null,

            'order' => fake()->numberBetween(1, 10),

            'duration' => fake()->numberBetween(
                5,
                45
            ),
        ];
    }
}
<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\CourseCategory>
 */
class CourseCategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->unique()->words(
            fake()->numberBetween(1, 3),
            true
        );

        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
        ];
    }
}
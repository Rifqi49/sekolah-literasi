<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\CourseRegistration>
 */
class CourseRegistrationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'course_id' => Course::factory(),

            'status' => fake()->randomElement([
                'registered',
                'in_progress',
                'completed',
            ]),

            'registered_at' => fake()->dateTimeBetween(
                '-6 months',
                'now'
            ),

            'completed_at' => null,
        ];
    }
}
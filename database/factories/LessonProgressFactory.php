<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\LessonProgress>
 */
class LessonProgressFactory extends Factory
{
    public function definition(): array
    {
        $completed = fake()->boolean(70);

        return [
            'user_id' => User::factory(),

            'lesson_id' => Lesson::factory(),

            'completed' => $completed,

            'completed_at' => $completed
                ? fake()->dateTimeBetween('-3 months', 'now')
                : null,
        ];
    }
}
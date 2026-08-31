<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ReadingHistory>
 */
class ReadingHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),

            'book_id' => Book::factory(),

            'progress' => fake()->numberBetween(
                1,
                100
            ),

            'last_page' => fake()->numberBetween(
                1,
                400
            ),

            'last_read_at' => fake()->dateTimeBetween(
                '-3 months',
                'now'
            ),
        ];
    }
}
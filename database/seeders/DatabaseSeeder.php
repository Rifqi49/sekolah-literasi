<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Bookmark;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\CourseRegistration;
use App\Models\Lesson;
use App\Models\LessonProgress;
use App\Models\ReadingHistory;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */
        $students = collect();

        $students->push(
            User::factory()
                ->student()
                ->create([
                    'name' => 'Student Demo',
                    'email' => 'student@sekolahliterasi.test',
                ])
        );

        $students = $students->merge(
            User::factory()
                ->student()
                ->count(10)
                ->create()
        );
        /*
        |--------------------------------------------------------------------------
        | BOOK CATEGORIES
        |--------------------------------------------------------------------------
        */

        $bookCategories = collect([
            [
                'name' => 'Literasi Dasar',
                'slug' => 'literasi-dasar',
                'description' => 'Buku yang membantu membangun kemampuan literasi dasar.',
            ],
            [
                'name' => 'Pendidikan',
                'slug' => 'pendidikan',
                'description' => 'Buku seputar pendidikan dan pembelajaran.',
            ],
            [
                'name' => 'Pengembangan Diri',
                'slug' => 'pengembangan-diri',
                'description' => 'Buku untuk pengembangan kemampuan dan karakter diri.',
            ],
            [
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Buku mengenai teknologi dan perkembangan digital.',
            ],
            [
                'name' => 'Literasi Digital',
                'slug' => 'literasi-digital',
                'description' => 'Buku mengenai kemampuan memahami dan menggunakan teknologi digital.',
            ],
            [
                'name' => 'Sains',
                'slug' => 'sains',
                'description' => 'Buku mengenai ilmu pengetahuan dan sains.',
            ],
        ])->map(
            fn (array $category) => BookCategory::create($category)
        );

        /*
        |--------------------------------------------------------------------------
        | AUTHORS
        |--------------------------------------------------------------------------
        */

        $authors = Author::factory()
            ->count(10)
            ->create();

        /*
        |--------------------------------------------------------------------------
        | BOOKS
        |--------------------------------------------------------------------------
        */

        $books = Book::factory()
            ->count(20)
            ->published()
            ->create()
            ->each(function (Book $book) use ($bookCategories, $authors) {
                $book->update([
                    'category_id' => $bookCategories->random()->id,
                ]);

                $book->authors()->attach(
                    $authors->random(
                        fake()->numberBetween(1, 2)
                    )->pluck('id')->toArray()
                );
            });

        /*
        |--------------------------------------------------------------------------
        | COURSE CATEGORIES
        |--------------------------------------------------------------------------
        */

        $courseCategories = collect([
            [
                'name' => 'Literasi Dasar',
                'slug' => 'literasi-dasar',
                'description' => 'Kelas untuk membangun kemampuan literasi dasar.',
            ],
            [
                'name' => 'Literasi Digital',
                'slug' => 'literasi-digital',
                'description' => 'Kelas untuk meningkatkan kemampuan literasi digital.',
            ],
            [
                'name' => 'Membaca',
                'slug' => 'membaca',
                'description' => 'Kelas untuk meningkatkan kemampuan membaca.',
            ],
            [
                'name' => 'Menulis',
                'slug' => 'menulis',
                'description' => 'Kelas untuk meningkatkan kemampuan menulis.',
            ],
            [
                'name' => 'Public Speaking',
                'slug' => 'public-speaking',
                'description' => 'Kelas untuk meningkatkan kemampuan berbicara di depan umum.',
            ],
        ])->map(
            fn (array $category) => CourseCategory::create($category)
        );

        /*
        |--------------------------------------------------------------------------
        | COURSES + LESSONS
        |--------------------------------------------------------------------------
        */

        $courses = Course::factory()
            ->count(10)
            ->published()
            ->create()
            ->each(function (Course $course) use ($courseCategories) {
                $course->update([
                    'category_id' => $courseCategories->random()->id,
                ]);

                Lesson::factory()
                    ->count(fake()->numberBetween(4, 7))
                    ->create([
                        'course_id' => $course->id,
                    ])
                    ->each(function (Lesson $lesson, $index) {
                        $lesson->update([
                            'order' => $index + 1,
                        ]);
                    });
            });

        /*
        |--------------------------------------------------------------------------
        | COURSE REGISTRATIONS
        |--------------------------------------------------------------------------
        */

        foreach ($students as $student) {
            $registeredCourses = $courses
                ->random(fake()->numberBetween(2, 5));

            foreach ($registeredCourses as $course) {
                $status = fake()->randomElement([
                    'registered',
                    'in_progress',
                    'completed',
                ]);

                CourseRegistration::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'status' => $status,
                    'registered_at' => now()->subDays(
                        fake()->numberBetween(1, 90)
                    ),
                    'completed_at' => $status === 'completed'
                        ? now()->subDays(
                            fake()->numberBetween(1, 30)
                        )
                        : null,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | LESSON PROGRESS
        |--------------------------------------------------------------------------
        */

        foreach ($students as $student) {
            $registrations = CourseRegistration::where(
                'user_id',
                $student->id
            )->get();

            foreach ($registrations as $registration) {
                $lessons = $registration->course
                    ->lessons;

                foreach ($lessons as $lesson) {
                    if (fake()->boolean(60)) {
                        LessonProgress::create([
                            'user_id' => $student->id,
                            'lesson_id' => $lesson->id,
                            'completed' => true,
                            'completed_at' => now()->subDays(
                                fake()->numberBetween(1, 60)
                            ),
                        ]);
                    }
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | READING HISTORIES
        |--------------------------------------------------------------------------
        */

        foreach ($students as $student) {
            $studentBooks = $books->random(
                fake()->numberBetween(2, 6)
            );

            foreach ($studentBooks as $book) {
                ReadingHistory::create([
                    'user_id' => $student->id,
                    'book_id' => $book->id,
                    'progress' => fake()->numberBetween(5, 100),
                    'last_page' => fake()->numberBetween(1, 300),
                    'last_read_at' => now()->subDays(
                        fake()->numberBetween(0, 60)
                    ),
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | BOOKMARKS
        |--------------------------------------------------------------------------
        */

        foreach ($students as $student) {
            $studentBooks = $books->random(
                fake()->numberBetween(1, 4)
            );

            foreach ($studentBooks as $book) {
                Bookmark::firstOrCreate([
                    'user_id' => $student->id,
                    'book_id' => $book->id,
                ]);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | REVIEWS
        |--------------------------------------------------------------------------
        */

        foreach ($students as $student) {
            $reviewBooks = $books->random(
                fake()->numberBetween(1, 3)
            );

            foreach ($reviewBooks as $book) {
                Review::firstOrCreate(
                    [
                        'user_id' => $student->id,
                        'reviewable_type' => Book::class,
                        'reviewable_id' => $book->id,
                    ],
                    [
                        'rating' => fake()->numberBetween(3, 5),
                        'comment' => fake()->paragraph(),
                    ]
                );
            }

            $reviewCourses = $courses->random(
                fake()->numberBetween(1, 2)
            );

            foreach ($reviewCourses as $course) {
                Review::firstOrCreate(
                    [
                        'user_id' => $student->id,
                        'reviewable_type' => Course::class,
                        'reviewable_id' => $course->id,
                    ],
                    [
                        'rating' => fake()->numberBetween(3, 5),
                        'comment' => fake()->paragraph(),
                    ]
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SUMMARY
        |--------------------------------------------------------------------------
        */

        $this->command->info('=========================================='); 
        $this->command->info(' SEKOLAH LITERASI - DATABASE SEEDED');
        $this->command->info('==========================================');
        $this->command->info('Students : ' . $students->count());
        $this->command->info('Books    : ' . $books->count());
        $this->command->info('Courses  : ' . $courses->count());
        $this->command->info('==========================================');
    }
}
<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Course;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ContentGrowthChart extends ChartWidget
{
    protected ?string $heading = 'Pertumbuhan Buku & Kelas';

    protected ?string $description = 'Jumlah buku dan kelas yang ditambahkan dalam 6 bulan terakhir.';

    protected function getData(): array
    {
        $months = collect(range(5, 0))
            ->map(function (int $month) {
                return Carbon::now()
                    ->subMonths($month)
                    ->startOfMonth();
            });

        $labels = $months->map(
            fn (Carbon $date) => $date->translatedFormat('M Y')
        )->toArray();

        $books = $months->map(function (Carbon $date) {
            return Book::query()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        })->toArray();

        $courses = $months->map(function (Carbon $date) {
            return Course::query()
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        })->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Buku',
                    'data' => $books,
                ],
                [
                    'label' => 'Kelas',
                    'data' => $courses,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
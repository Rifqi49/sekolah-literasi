<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(
                'Total Pengguna',
                User::where('role', 'student')->count()
            )
                ->description('Pengguna terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make(
                'Total Buku',
                Book::count()
            )
                ->description('Koleksi perpustakaan')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('success'),

            Stat::make(
                'Total Kelas',
                Course::count()
            )
                ->description('Kelas pembelajaran')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('warning'),

            Stat::make(
                'Pendaftaran Kelas',
                CourseRegistration::count()
            )
                ->description('Total pendaftaran')
                ->descriptionIcon('heroicon-m-clipboard-document-check')
                ->color('info'),

            Stat::make(
                'Buku Published',
                Book::where('status', 'published')->count()
            )
                ->description('Buku tersedia untuk dibaca')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make(
                'Kelas Published',
                Course::where('status', 'published')->count()
            )
                ->description('Kelas tersedia')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
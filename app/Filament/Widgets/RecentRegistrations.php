<?php

namespace App\Filament\Widgets;

use App\Models\CourseRegistration;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentRegistrations extends TableWidget
{
    protected static ?string $heading = 'Pendaftaran Kelas Terbaru';

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CourseRegistration::query()
                    ->with([
                        'user',
                        'course',
                    ])
                    ->latest('registered_at')
            )
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Siswa')
                    ->searchable(),

                Tables\Columns\TextColumn::make('course.title')
                    ->label('Kelas')
                    ->limit(30),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'registered' => 'info',
                        'in_progress' => 'warning',
                        'completed' => 'success',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('registered_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false)
            ->defaultPaginationPageOption(5);
    }
}
<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PopularBooks extends TableWidget
{
    protected static ?string $heading = 'Buku Terpopuler';

    protected int | string | array $columnSpan = 1;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Book::query()
                    ->with('category')
                    ->orderByDesc('views')
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(35)
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge(),

                Tables\Columns\TextColumn::make('views')
                    ->label('Dibaca')
                    ->numeric()
                    ->sortable(),
            ])
            ->paginated(false)
            ->defaultPaginationPageOption(5);
    }
}
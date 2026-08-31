<?php

namespace App\Filament\Resources\ReadingHistories\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ReadingHistoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('book_id')
                    ->relationship('book', 'title')
                    ->required(),
                TextInput::make('progress')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('last_page')
                    ->numeric(),
                DateTimePicker::make('last_read_at'),
            ]);
    }
}

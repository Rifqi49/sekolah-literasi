<?php

namespace App\Filament\Resources\ReadingHistories\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ReadingHistoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('User'),
                TextEntry::make('book.title')
                    ->label('Book'),
                TextEntry::make('progress')
                    ->numeric(),
                TextEntry::make('last_page')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('last_read_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}

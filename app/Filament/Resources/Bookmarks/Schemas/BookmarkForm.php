<?php

namespace App\Filament\Resources\Bookmarks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class BookmarkForm
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
            ]);
    }
}

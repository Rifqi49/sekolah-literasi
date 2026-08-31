<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Penulis')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                FileUpload::make('photo')
                    ->label('Foto Penulis')
                    ->image()
                    ->disk('public')
                    ->directory('authors'),

                Textarea::make('bio')
                    ->label('Biografi')
                    ->rows(6)
                    ->columnSpanFull(),
            ]);
    }
}
<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->label('Judul Buku')
                    ->required()
                    ->maxLength(255),

                TextInput::make('author')
                    ->label('Penulis')
                    ->required()
                    ->maxLength(255),

                TextInput::make('publisher')
                    ->label('Penerbit')
                    ->maxLength(255),

                TextInput::make('year')
                    ->label('Tahun Terbit')
                    ->numeric()
                    ->minValue(1900)
                    ->maxValue(date('Y')),

                Textarea::make('synopsis')
                    ->label('Sinopsis')
                    ->rows(5)
                    ->columnSpanFull(),

                FileUpload::make('cover')
                    ->label('Cover Buku')
                    ->image()
                    ->directory('books/covers')
                    ->imageEditor(),

                TextInput::make('stock')
                    ->label('Stok')
                    ->numeric()
                    ->default(0)
                    ->minValue(0)
                    ->required(),

                Select::make('is_available')
                    ->label('Status Ketersediaan')
                    ->options([
                        true => 'Tersedia',
                        false => 'Tidak Tersedia',
                    ])
                    ->default(true)
                    ->required(),

            ]);
    }
}
<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CourseForm
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
                    ->label('Judul Kelas')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(6)
                    ->columnSpanFull(),

                TextInput::make('instructor')
                    ->label('Instruktur')
                    ->maxLength(255),

                Select::make('level')
                    ->label('Tingkat')
                    ->options([
                        'beginner' => 'Pemula',
                        'intermediate' => 'Menengah',
                        'advanced' => 'Lanjutan',
                    ])
                    ->required(),

                TextInput::make('duration')
                    ->label('Durasi (menit)')
                    ->numeric()
                    ->minValue(1),

                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('courses/thumbnails')
                    ->imageEditor(),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),
            ]);
    }
}
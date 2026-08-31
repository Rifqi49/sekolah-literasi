<?php

namespace App\Filament\Resources\Lessons\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('course_id')
                    ->label('Kelas')
                    ->relationship('course', 'title')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('title')
                    ->label('Judul Materi')
                    ->required(),

                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3),

                RichEditor::make('content')
                    ->label('Isi Materi')
                    ->columnSpanFull(),

                TextInput::make('video_url')
                    ->label('URL Video')
                    ->url()
                    ->maxLength(255),

                FileUpload::make('attachment')
                    ->label('Lampiran')
                    ->disk('public')
                    ->directory('lessons/attachments'),

                TextInput::make('order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required(),

                TextInput::make('duration')
                    ->label('Durasi (menit)')
                    ->numeric(),
            ]);
    }
}
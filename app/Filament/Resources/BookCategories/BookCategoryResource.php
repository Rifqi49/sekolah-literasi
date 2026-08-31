<?php

namespace App\Filament\Resources\BookCategories;

use App\Filament\Resources\BookCategories\Pages\CreateBookCategory;
use App\Filament\Resources\BookCategories\Pages\EditBookCategory;
use App\Filament\Resources\BookCategories\Pages\ListBookCategories;
use App\Filament\Resources\BookCategories\Pages\ViewBookCategory;
use App\Filament\Resources\BookCategories\Schemas\BookCategoryForm;
use App\Filament\Resources\BookCategories\Tables\BookCategoriesTable;
use App\Models\BookCategory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class BookCategoryResource extends Resource
{
    protected static ?string $model = BookCategory::class;

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationLabel = 'Kategori Buku';

    protected static ?string $modelLabel = 'kategori buku';

    protected static ?string $pluralModelLabel = 'kategori buku';

    protected static string | UnitEnum | null $navigationGroup = 'Perpustakaan';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return BookCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookCategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBookCategories::route('/'),
            'create' => CreateBookCategory::route('/create'),
            'view' => ViewBookCategory::route('/{record}'),
            'edit' => EditBookCategory::route('/{record}/edit'),
        ];
    }
}
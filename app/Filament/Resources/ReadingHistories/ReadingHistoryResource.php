<?php

namespace App\Filament\Resources\ReadingHistories;

use App\Filament\Resources\ReadingHistories\Pages\CreateReadingHistory;
use App\Filament\Resources\ReadingHistories\Pages\EditReadingHistory;
use App\Filament\Resources\ReadingHistories\Pages\ListReadingHistories;
use App\Filament\Resources\ReadingHistories\Pages\ViewReadingHistory;
use App\Filament\Resources\ReadingHistories\Schemas\ReadingHistoryForm;
use App\Filament\Resources\ReadingHistories\Schemas\ReadingHistoryInfolist;
use App\Filament\Resources\ReadingHistories\Tables\ReadingHistoriesTable;
use App\Models\ReadingHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ReadingHistoryResource extends Resource
{
    protected static ?string $model = ReadingHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ReadingHistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ReadingHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ReadingHistoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListReadingHistories::route('/'),
            'create' => CreateReadingHistory::route('/create'),
            'view' => ViewReadingHistory::route('/{record}'),
            'edit' => EditReadingHistory::route('/{record}/edit'),
        ];
    }
}

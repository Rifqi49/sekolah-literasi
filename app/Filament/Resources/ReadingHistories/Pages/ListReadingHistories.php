<?php

namespace App\Filament\Resources\ReadingHistories\Pages;

use App\Filament\Resources\ReadingHistories\ReadingHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListReadingHistories extends ListRecords
{
    protected static string $resource = ReadingHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}

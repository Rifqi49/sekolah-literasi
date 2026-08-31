<?php

namespace App\Filament\Resources\ReadingHistories\Pages;

use App\Filament\Resources\ReadingHistories\ReadingHistoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewReadingHistory extends ViewRecord
{
    protected static string $resource = ReadingHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

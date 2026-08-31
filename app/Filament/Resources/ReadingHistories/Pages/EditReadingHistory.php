<?php

namespace App\Filament\Resources\ReadingHistories\Pages;

use App\Filament\Resources\ReadingHistories\ReadingHistoryResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditReadingHistory extends EditRecord
{
    protected static string $resource = ReadingHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}

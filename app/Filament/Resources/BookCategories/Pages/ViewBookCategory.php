<?php

namespace App\Filament\Resources\BookCategories\Pages;

use App\Filament\Resources\BookCategories\BookCategoryResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewBookCategory extends ViewRecord
{
    protected static string $resource = BookCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}

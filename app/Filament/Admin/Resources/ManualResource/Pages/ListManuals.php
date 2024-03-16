<?php

namespace App\Filament\Admin\Resources\ManualResource\Pages;

use App\Filament\Admin\Resources\ManualResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManuals extends ListRecords
{
    protected static string $resource = ManualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

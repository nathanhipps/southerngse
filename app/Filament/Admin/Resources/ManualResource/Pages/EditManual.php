<?php

namespace App\Filament\Admin\Resources\ManualResource\Pages;

use App\Filament\Admin\Resources\ManualResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManual extends EditRecord
{
    protected static string $resource = ManualResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

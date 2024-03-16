<?php

namespace App\Filament\Admin\Resources\UsedEquipmentResource\Pages;

use App\Filament\Admin\Resources\UsedEquipmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUsedEquipment extends EditRecord
{
    protected static string $resource = UsedEquipmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

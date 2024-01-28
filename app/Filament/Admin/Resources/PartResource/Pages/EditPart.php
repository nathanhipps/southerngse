<?php

namespace App\Filament\Admin\Resources\PartResource\Pages;

use App\Filament\Admin\Resources\PartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPart extends EditRecord
{
    protected static string $resource = PartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

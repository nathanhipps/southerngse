<?php

namespace App\Filament\Admin\Resources\PartResource\Pages;

use App\Filament\Admin\Resources\PartResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePart extends CreateRecord
{
    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['price'] = $data['price'] * 100;
        $data['cost'] = $data['cost'] * 100;
        return $data;
    }

    protected static string $resource = PartResource::class;
}

<?php

namespace App\Filament\Imports;

use App\Models\Part;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class PartsPricingImporter extends Importer
{
    protected static ?string $model = Part::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sku')
                ->label('SKU')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('price')
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('cost')
                ->numeric()
                ->rules(['integer']),
            ImportColumn::make('inventory')
                ->numeric(),
        ];
    }

    public function resolveRecord(): ?Part
    {
        return Part::query()
            ->where('sku', $this->data['sku'])
            ->first();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your parts pricing update has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}

<?php

namespace App\Filament\Imports;

use App\Models\Part;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Str;

class PartImporter extends Importer
{
    protected static ?string $model = Part::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('sku')
                ->label('SKU')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('description')
                ->requiredMapping()
                ->rules(['required', 'max:255']),
            ImportColumn::make('price')
                ->numeric()
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('cost')
                ->numeric()
                ->requiredMapping(),
            ImportColumn::make('inventory')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('lead_time_in_days')
                ->requiredMapping()
                ->numeric()
                ->rules(['required', 'integer']),
            ImportColumn::make('slug')
                ->castStateUsing(function ($state, $data): ?string {
                    if ($state) {
                        return $state;
                    }
                    return Str::of($data['sku'].'-'.$data['description'])->slug()->toString();
                }),
            ImportColumn::make('manufacturer')
                ->requiredMapping()
                ->relationship(resolveUsing: 'name')
        ];
    }

    public function resolveRecord(): ?Part
    {
        return Part::firstOrNew([
            // Update existing records, matching them by `$this->data['column_name']`
            'sku' => $this->data['sku'],
        ]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your part import has completed and '.number_format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}

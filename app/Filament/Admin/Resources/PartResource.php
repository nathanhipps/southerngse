<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PartResource\Pages;
use App\Filament\Imports\PartImporter;
use App\Filament\Imports\PartsPricingImporter;
use App\Models\Manufacturer;
use App\Models\Part;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PartResource extends Resource
{
    protected static ?string $model = Part::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('sku'),
                Textarea::make('description'),
                TextInput::make('price')
                    ->numeric()
                    ->inputMode('decimal')
                    ->prefixIcon('heroicon-o-currency-dollar'),

                TextInput::make('cost')
                    ->numeric()
                    ->inputMode('decimal')
                    ->prefixIcon('heroicon-o-currency-dollar'),

                TextInput::make('inventory')
                    ->numeric(),

                TextInput::make('lead_time_in_days')
                    ->numeric(),

                FileUpload::make('image_path')
                    ->image()
                    ->disk('do')
                    ->visibility('public')
                    ->directory(env('APP_ENV').'/parts/images')
                    ->imageEditor(),

                Select::make('manufacturer_id')
                    ->label('Manufacturer')
                    ->options(Manufacturer::all()->pluck('name', 'id'))
                    ->searchable()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sku')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->wrap()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('cost')
                    ->money(),
                TextColumn::make('price')
                    ->money(),
                TextColumn::make('manufacturer.name')
                    ->sortable()
            ])
            ->filters([
                SelectFilter::make('manufacturer')
                    ->relationship('manufacturer', 'name')
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(PartImporter::class)
                    ->options([
                        'updateExisting' => true,
                    ]),
                Tables\Actions\ImportAction::make()
                    ->label('Update Pricing')
                    ->importer(PartsPricingImporter::class)
                    ->options([
                        'updateExisting' => true,
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListParts::route('/'),
            'create' => Pages\CreatePart::route('/create'),
            'edit' => Pages\EditPart::route('/{record}/edit'),
        ];
    }
}

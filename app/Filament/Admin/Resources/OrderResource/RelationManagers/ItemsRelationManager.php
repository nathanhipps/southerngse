<?php

namespace App\Filament\Admin\Resources\OrderResource\RelationManagers;

use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('sku')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sku')
            ->columns([
                TextColumn::make('quantity')
                    ->numeric()
                    ->alignCenter(),
                TextColumn::make('sku'),
                TextColumn::make('description'),
                TextColumn::make('price')
                    ->money(divideBy: 100)
                    ->alignRight()
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
                BulkActionGroup::make([

                ])
            ])
            ->bulkActions([
                BulkAction::make('ship')
                    ->steps([
                        Forms\Components\Wizard\Step::make('quantities')
                            ->description('Select the quantities of each item being shipped')
                            ->schema(function ($livewire) {
                                return $livewire->getSelectedTableRecords()->map(function ($record) {
                                    return Forms\Components\Select::make($record->part->sku)
                                        ->options(range(0, $record->quantity))
                                        ->required();
                                })->toArray();
                            }),
                        Forms\Components\Wizard\Step::make('shipping')
                            ->description('Fill out all the shipping information')
                            ->schema([
                                Forms\Components\TextInput::make('tax_amount')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('shipping_amount')
                                    ->numeric()
                                    ->required(),
                                Forms\Components\TextInput::make('freight_carrier')
                                    ->required(),
                                Forms\Components\TextInput::make('tracking_number')
                                    ->required()
                            ])
                    ])
                    ->label('Ship and Charge')
                    ->slideOver()
                    ->action(function (array $data) {
                        Order::process($data);
                        return redirect('/admin/orders');
                    })
            ]);
    }
}

<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrderResource\Pages;
use App\Filament\Admin\Resources\OrderResource\RelationManagers\ItemsRelationManager;
use App\Models\Order;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('number')
                    ->sortable(),
                Tables\Columns\IconColumn::make('Closed')
                    ->boolean()
                    ->getStateUsing(fn($record): bool => blank($record->closed_at))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('address')
                    ->formatStateUsing(fn($state): string => $state->name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('card')
                    ->formatStateUsing(fn($state): string => $state->brand.' '.$state->last_four),
                Tables\Columns\TextColumn::make('carrier.name'),
                Tables\Columns\TextColumn::make('total')
                    ->money(divideBy: 100)
                    ->alignEnd(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            Split::make([
                Section::make([
                    TextEntry::make('number')
                        ->label('Order Number'),
                    IconEntry::make('Closed')
                        ->boolean()
                        ->getStateUsing(fn($record): bool => blank($record->closed_at)),
                    TextEntry::make('user.name'),
                    TextEntry::make('address')
                        ->formatStateUsing(function ($state) {
                            return $state->street
                                .($state->details ? '<br>'.$state->details : '')
                                .'<br>'.$state->city.', '.$state->state.' '.$state->zip;
                        })->html(),
                    TextEntry::make('card')
                        ->formatStateUsing(fn($state) => $state->brand.' ending in'.$state->last_four),
                    TextEntry::make('carrier')
                        ->formatStateUsing(fn($state) => $state->name.': '.$state->account_number),
                    TextEntry::make('shipping_time'),
                ])->columns(2),
                Section::make([
                    TextEntry::make('subtotal')
                        ->money(divideBy: 100),
                    TextEntry::make('tax')
                        ->money(divideBy: 100),
                    TextEntry::make('shipping')
                        ->money(divideBy: 100),
                    TextEntry::make('total')
                        ->money(divideBy: 100),
                ])->grow(false),
            ])->columnSpan(2)
        ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'view' => Pages\ViewOrder::route('/{record}'),
        ];
    }
}

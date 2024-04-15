<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RentalResource\Pages;
use App\Filament\Admin\Resources\RentalResource\RelationManagers;
use App\Models\Rental;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RentalResource extends Resource
{
    protected static ?string $model = Rental::class;
    protected static ?string $pluralLabel = 'Rental Equipment';


    protected static ?string $navigationIcon = 'heroicon-o-truck';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('model_number')
                    ->required(),
                TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                RichEditor::make('description')
                    ->required()
                    ->columnSpan(2),
                FileUpload::make('image_path')
                    ->image()
                    ->disk('do')
                    ->visibility('public')
                    ->directory(env('APP_ENV').'/used_equipment/images')
                    ->imageEditor(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('model_number')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image_path')
                    ->label('image'),
                TextColumn::make('quantity'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListRentals::route('/'),
            'create' => Pages\CreateRental::route('/create'),
            'edit' => Pages\EditRental::route('/{record}/edit'),
        ];
    }
}

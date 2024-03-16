<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ManualResource\Pages;
use App\Filament\Admin\Resources\ManualResource\RelationManagers;
use App\Models\Manual;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManualResource extends Resource
{
    protected static ?string $model = Manual::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                FileUpload::make('file_path')
                    ->label('Manual')
                    ->required()
                    ->disk('do')
                    ->visibility('public')
                    ->directory(env('APP_ENV').'/manuals'),
                RichEditor::make('description')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListManuals::route('/'),
            'create' => Pages\CreateManual::route('/create'),
            'edit' => Pages\EditManual::route('/{record}/edit'),
        ];
    }
}

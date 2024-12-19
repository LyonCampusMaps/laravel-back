<?php

namespace App\Filament\Resources;

use App\Filament\Imports\InterestPointImporter;
use App\Filament\Exports\InterestPointExporter;
use App\Filament\Resources\InterestPointResource\Pages;
use App\Models\InterestPoint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InterestPointResource extends Resource
{
    protected static ?string $model = InterestPoint::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required(),
                Forms\Components\TextInput::make('address'),
                Forms\Components\TextInput::make('latitude')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('longitude')
                    ->numeric()
                    ->required(),
                Forms\Components\KeyValue::make('attributes')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),
            ])
            ->headerActions([
                Tables\Actions\ImportAction::make()
                    ->importer(InterestPointImporter::class),
                Tables\Actions\ExportAction::make()
                    ->exporter(InterestPointExporter::class),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInterestPoints::route('/'),
            'create' => Pages\CreateInterestPoint::route('/create'),
            'edit' => Pages\EditInterestPoint::route('/{record}/edit'),
        ];
    }
}

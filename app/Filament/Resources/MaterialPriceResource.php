<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MaterialPriceResource\Pages;
use App\Filament\Resources\MaterialPriceResource\RelationManagers;
use App\Models\MaterialPrice;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaterialPriceResource extends Resource
{
    protected static ?string $model = MaterialPrice::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Precios de Materiales';
    protected static ?string $navigationGroup = 'Materia Prima';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('material_id')
                    ->label('Material')
                    ->relationship('material', 'name')
                    ->searchable()
                    ->required(),

                TextInput::make('price_per_sqm')
                    ->label('Precio por m²')
                    ->numeric()
                    ->required()
                    ->prefix('$'),

                TextInput::make('format')
                    ->label('Formato')
                    ->default('210x244')
                    ->required(),

                TextInput::make('thickness')
                    ->label('Espesor')
                    ->default('15-35mm')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('material.name')->label('Material')->searchable(),
                TextColumn::make('price_per_sqm')->label('Precio m²')->money('USD')->searchable(),
                TextColumn::make('format')->searchable()->label('Formato'),
                TextColumn::make('thickness')->searchable()->label('Espesor'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha de Creación'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Fecha de Actualización'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageMaterialPrices::route('/'),
        ];
    }
}

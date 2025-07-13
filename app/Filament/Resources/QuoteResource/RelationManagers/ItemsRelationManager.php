<?php

namespace App\Filament\Resources\QuoteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                TextColumn::make('product.name')->label('Producto')->searchable(),
                TextColumn::make('product.category.name')->label('Categoría')->searchable(),
                TextColumn::make('material_price.price_per_sqm')->label('Precio por m²')->searchable(),
                TextColumn::make('material_price.material.name')->label('Material')->searchable(),
                TextColumn::make('width')->label('Ancho (cm)'),
                TextColumn::make('depth')->label('Profundidad (cm)'),
                TextColumn::make('quantity')->label('Cantidad'),
                TextColumn::make('unit_price')->label('Precio Unitario')->money('USD'),
                TextColumn::make('total_price')->label('Precio Total')->money('USD'),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([])
            ->bulkActions([]);
    }
}

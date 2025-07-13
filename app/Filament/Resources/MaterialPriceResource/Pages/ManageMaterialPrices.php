<?php

namespace App\Filament\Resources\MaterialPriceResource\Pages;

use App\Filament\Resources\MaterialPriceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageMaterialPrices extends ManageRecords
{
    protected static string $resource = MaterialPriceResource::class;
    protected static ?string $title = 'Precios de Materiales';
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Nuevo Precio de Mateterial')
                ->modalHeading('Crear Precio de Material')
        ];
    }
}

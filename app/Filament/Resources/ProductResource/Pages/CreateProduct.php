<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    // protected function getFormActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make()
    //             ->label('Crear') // Cambia texto si deseas
    //             ->extraAttributes([
    //                 'style' => 'background-color: #344966; color: white;',
    //                 'onmouseover' => "this.style.backgroundColor='#2c3d59'",
    //                 'onmouseout' => "this.style.backgroundColor='#344966'",
    //             ]),
    //         ##Actions\CreateAndCreateAnotherAction::make(),
    //         ##Actions\CancelAction::make(),
    //     ];
    // }
}

<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->url(route('filament.admin.resources.products.create'))
                ->button()
                ->color('gray') // neutral color to allow custom bg
                ->extraAttributes([
                    'style' => 'background-color: #1A5275; color: white;',
                    'onmouseover' => "this.style.backgroundColor='#2c3d59'",
                    'onmouseout' => "this.style.backgroundColor='#1A5275'",
                ]),
        ];
    }
}

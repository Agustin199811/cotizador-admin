<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCategories extends ManageRecords
{
    protected static string $resource = CategoryResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->button()
                ->color('gray')
                ->extraAttributes([
                    'style' => 'background-color: #1A5275; color: white;',
                    'onmouseover' => "this.style.backgroundColor='#2c3d59'",
                    'onmouseout' => "this.style.backgroundColor='#1A5275'",
                ]),
        ];
    }
}

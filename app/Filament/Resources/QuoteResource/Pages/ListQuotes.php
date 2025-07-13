<?php

namespace App\Filament\Resources\QuoteResource\Pages;

use App\Filament\Resources\QuoteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuotes extends ListRecords
{
    protected static string $resource = QuoteResource::class;
    protected static ?string $title = 'Cotizaciones';

    protected function getHeaderActions(): array
    {
        return [
            
        ];
    }
}

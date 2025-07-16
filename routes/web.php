<?php

use App\Http\Controllers\Admin\QuoteDownloadController;
use App\Livewire\QuoteForm;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin');
Route::get('/cotizar', QuoteForm::class)->name('quote.create');
Route::get('/admin/quotes/{quote}/download', [QuoteDownloadController::class, 'download'])->name('quotes.download');
Route::get('/cotizacion/{quote}/descargar', [QuoteDownloadController::class, 'download'])
    ->name('quote.download');

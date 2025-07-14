<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuoteDownloadController extends Controller
{
    public function download(Quote $quote)
    {
        $quote->load('items.product.category', 'items.materialPrice.material');

        $pdf = Pdf::loadView('pdf.quote', [
            'quote' => $quote,
        ]);

        return $pdf->download("Cotizacion-{$quote->client_name}-{$quote->id}.pdf");
    }
}

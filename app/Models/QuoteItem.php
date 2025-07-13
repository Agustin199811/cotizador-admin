<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id',
        'category_id',
        'product_id',
        'material_id',
        'material_price_id',
        'width',
        'depth',
        'quantity',
        'unit_price',
        'total_price',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }


    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class);
    }

    public function materialPrice(): BelongsTo
    {
        return $this->belongsTo(MaterialPrice::class);
    }
}

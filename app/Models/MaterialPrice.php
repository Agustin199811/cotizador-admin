<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialPrice extends Model
{
    protected $fillable = [
        'material_id',
        'price_per_sqm',
        'format',
        'thickness',
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}

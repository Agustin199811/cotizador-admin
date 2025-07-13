<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialPrice extends Model
{
    protected $fillable = [
        'material_id',
        'price_per_sqm',
        'format',
        'thickness',
    ];
    use SoftDeletes;

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'price',
        'cost',
        'category_id',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

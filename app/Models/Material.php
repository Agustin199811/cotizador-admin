<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['name', 'type'];

    public function prices()
    {
        return $this->hasMany(MaterialPrice::class);
    }
}

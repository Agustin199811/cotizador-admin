<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    protected $fillable = ['name', 'type'];
    use SoftDeletes;

    public function prices()
    {
        return $this->hasMany(MaterialPrice::class);
    }
}

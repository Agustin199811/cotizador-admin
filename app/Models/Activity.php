<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity_log';

    public function causer()
    {
        return $this->belongsTo(\App\Models\User::class, 'causer_id');
    }
}

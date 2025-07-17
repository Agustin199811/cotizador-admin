<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Product extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'is_active'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

      public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name' , 'description', 'category_id', 'is_active'])       // Solo registra cambios en estos atributos
            ->logOnlyDirty()          // Solo cuando hay cambios reales
            ->useLogName('productos') // Nombre del log que aparecerá en Filament
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); // Mensaje en el log
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class MaterialPrice extends Model
{
    protected $fillable = [
        'material_id',
        'price_per_sqm',
        'format',
        'thickness',
    ];
    use SoftDeletes, LogsActivity;

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

      public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['material_id', 'price_per_sqm', 'format', 'thickness'])       // Solo registra cambios en estos atributos
            ->logOnlyDirty()          // Solo cuando hay cambios reales
            ->useLogName('materiales por precio') // Nombre del log que aparecerá en Filament
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); // Mensaje en el log
    }
}

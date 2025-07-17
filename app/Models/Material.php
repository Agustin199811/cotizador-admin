<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Material extends Model
{
    protected $fillable = ['name', 'type'];
    use SoftDeletes, LogsActivity;

    public function prices()
    {
        return $this->hasMany(MaterialPrice::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'type'])       // Solo registra cambios en estos atributos
            ->logOnlyDirty()          // Solo cuando hay cambios reales
            ->useLogName('materiales') // Nombre del log que aparecerá en Filament
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); // Mensaje en el log
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use SoftDeletes, LogsActivity;
    protected $fillable = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name'])       // Solo registra cambios en estos atributos
            ->logOnlyDirty()          // Solo cuando hay cambios reales
            ->useLogName('categorias') // Nombre del log que aparecerá en Filament
            ->setDescriptionForEvent(fn(string $eventName) => "{$eventName}"); // Mensaje en el log
    }

}

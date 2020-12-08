<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class GreenhouseSection extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    //Nombre de la tabla en MySQL.
    protected $table = 'greenhouse_sections';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable = ['name_section', 'planting_type', 'greenhouse_id'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function greenhouses()
    {
        return $this->belongsTo(Greenhouse::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }

    public function lectureReadings()
    {
        return $this->hasManyThrough(TemperatureReading::class, Sensor::class);
    }
}

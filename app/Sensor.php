<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Sensor extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    //Nombre de la tabla en MySQL.
    protected $table = 'sensors';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable = ['model_sensor', 'serial_sensor', 'environmental_condition_id', 'arduino_id', 'greenhouse_section_id'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at', 'updated_at'];

    public function environmentalConditions()
    {
        return $this->belongsTo(EnvironmentalCondition::class);
    }

    public function arduinos()
    {
        return $this->belongsTo(Arduino::class);
    }

    public function sections()
    {
        return $this->belongsTo(GreenhouseSection::class);
    }

    public function temperatureReadings()
    {
        return $this->hasMany(TemperatureReading::class);
    }

}

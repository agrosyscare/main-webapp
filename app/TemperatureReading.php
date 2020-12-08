<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemperatureReading extends Model
{
    //Nombre de la tabla en MySQL.
    protected $table = 'temperature_readings';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable = ['reading', 'sensor_id', 'status'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at', 'updated_at'];

    //Relación
    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

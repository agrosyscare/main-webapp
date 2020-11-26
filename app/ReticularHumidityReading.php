<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReticularHumidityReading extends Model
{
    //Nombre de la tabla en MySQL.
    protected $table = 'reticular_humidity_readings';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable = ['reading', 'sensor_id', 'status'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at', 'updated_at'];

    //Relación
    public function sensors()
    {
        return $this->belongsTo('App\Sensors');
    }
}

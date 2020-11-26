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
    protected $table='sensors';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable= ['model_sensor','serial_sensor','environmental_condition_id', 'arduino_id', 'greenhouse_section_id'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at','updated_at'];

    public function environmentalConditions() {
        $this->belongsTo('App\EnvironmentalCondition');
    }

    public function arduinos() {
        $this->belongsTo('App\Arduino');
    }

    public function greenhouseSections() {
        $this->belongsTo('App\GreenhouseSection');
    }
}

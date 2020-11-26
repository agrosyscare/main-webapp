<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Arduino extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    //Nombre de la tabla en MySQL.
    protected $table='arduinos';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable= ['model_arduino', 'serial_arduino'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at','updated_at'];
}

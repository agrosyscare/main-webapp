<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Greenhouse extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    //Nombre de la tabla en MySQL.
    protected $table='greenhouses';

    //Atributos que se pueden asignar de manera masiva.
    protected $fillable= ['name_greenhouse'];

    //Campos que no queremos que se devuelvan en las consultas
    protected $hidden = ['created_at','updated_at','deleted_at'];
}

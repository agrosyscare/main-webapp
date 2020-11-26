<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemperatureReading extends Model
{
        //Nombre de la tabla en MySQL.
        protected $table='temperature_readings';

        //Atributos que se pueden asignar de manera masiva.
        protected $fillable= ['reading','sensor_id','status'];
        
        //Campos que no queremos que se devuelvan en las consultas
        protected $hidden = ['created_at','updated_at'];
        
        //Relación
        public function sensors()
        {
            return $this ->belongsTo('App\Sensors');
        }

        public function sendFCM($message) {
            fcm()
            ->to([
                $this->device_token
            ]) // $recipients must an array
            ->priority('high')
            ->timeToLive(0)
            ->notification([
                'title' => config('app.name'),
                'body' => 'This is a test of FCM',
            ])
            ->send();
        }
}

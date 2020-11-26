<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReticularHumidityReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reticular_humidity_readings', function (Blueprint $table) {
            $table->id();
            $table->double('reading'); 
            $table->foreignId('sensor_id')->references('id')->on('sensors');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reticular_humidity_readings');
    }
}

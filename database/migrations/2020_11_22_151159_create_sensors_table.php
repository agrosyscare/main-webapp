<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->id();
            $table->string('model_sensor');
            $table->integer('serial_sensor');
            $table->foreignId('environmental_condition_id')->references('id')->on('environmental_conditions')->onDelete('cascade');
            $table->foreignId('arduino_id')->references('id')->on('arduinos')->onDelete('cascade');
            $table->foreignId('greenhouse_section_id')->references('id')->on('greenhouse_sections')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('sensors');
    }
}

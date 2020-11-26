<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGreenhouseSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('greenhouse_sections', function (Blueprint $table) {
            $table->id();
            $table->string('name_section');
            $table->string('planting_type');
            $table->foreignId('greenhouse_id')->references('id')->on('greenhouses')->onDelete('cascade');
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
        Schema::dropIfExists('greenhouse_sections');
    }
}

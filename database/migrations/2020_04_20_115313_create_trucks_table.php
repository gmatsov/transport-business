<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->integer('production_year')->nullable();
            $table->integer('horse_power')->nullable();
            $table->string('licence_plate')->unique();
            $table->string('vin')->unique()->nullable();
            $table->integer('odometer');
            $table->unsignedBigInteger('emission_class')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('emission_class')->references('id')->on('emission_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('truck');
    }
}

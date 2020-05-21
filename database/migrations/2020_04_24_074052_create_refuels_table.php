<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefuelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refuels', function (Blueprint $table) {

            $table->id();
            $table->date('date');
            $table->decimal('quantity');
            $table->decimal('price');
            $table->integer('current_odometer');
            $table->integer('trip_odometer');
            $table->unsignedBigInteger('truck_id');
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->unsignedBigInteger('reporting_period_id');
            $table->foreign('reporting_period_id')->references('id')->on('reporting_periods');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('refuel');
    }
}

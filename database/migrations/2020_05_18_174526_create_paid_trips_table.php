<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id');
            $table->unsignedBigInteger('reporting_period_id');
            $table->integer('distance');
            $table->decimal('price_per_km');
            $table->foreign('truck_id')->references('id')->on('trucks');
            $table->foreign('reporting_period_id')->references('id')->on('reporting_periods');
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
        Schema::dropIfExists('paid_trip');
    }
}

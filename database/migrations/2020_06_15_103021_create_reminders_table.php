<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRemindersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('truck_id');
            $table->string('title');
            $table->string('note')->nullable();
            $table->date('by_date')->nullable();
            $table->integer('days_before')->default(0);
            $table->integer('by_odometer')->nullable();
            $table->integer('km_before')->nullable();
            $table->boolean('closed')->default(false);
            $table->date('finished_at')->nullable();
            $table->foreign('truck_id')->references('id')->on('trucks');
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
        Schema::dropIfExists('reminders');
    }
}

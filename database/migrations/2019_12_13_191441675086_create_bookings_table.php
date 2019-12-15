<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('room_id');
           
            $table->dateTime('from_date');
            $table->dateTime('to_date')->nullable();

            $table->timestamps();
            $table->softDeletes();

            # FK's
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('room_id')->references('id')->on('rooms');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}

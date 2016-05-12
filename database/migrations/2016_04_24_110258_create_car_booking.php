<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarBooking extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('car_id')->nullable()->unsigned();
			$table->integer('customer_id')->nullable()->unsigned();
			$table->date('dude_date');
            $table->string('amount');
			$table->foreign('car_id')->references('id')->on('car_master');
			$table->foreign('customer_id')->references('id')->on('customer_master');
            $table->integer('created_by')->nullable()->unsigned();
            $table->foreign('created_by')->references('id')->on('user_master');
            $table->integer('modified_by')->nullable()->unsigned();
            $table->foreign('modified_by')->references('id')->on('user_master');
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
        Schema::drop('car_booking');
    }
}

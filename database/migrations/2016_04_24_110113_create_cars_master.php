<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_master', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
			$table->string('brand_name');
            $table->string('description');
			$table->string('type');
            $table->string('color');
			$table->tinyInteger('is_booked');
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
        Schema::drop('car_master');
    }
}

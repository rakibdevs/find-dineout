<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurentCuisinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurent_cuisines', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurent_id');
            $table->unsignedBigInteger('cuisine_id');
            $table->timestamps();

            $table->foreign('restaurent_id')->references('id')->on('restaurents')->onDelete('cascade');
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurent_cuisines');
    }
}

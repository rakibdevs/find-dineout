<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurentOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurent_offers', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurent_id');
            $table->unsignedBigInteger('offer_id');
            $table->timestamps();

            $table->foreign('restaurent_id')->references('id')->on('restaurents')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurent_offers');
    }
}

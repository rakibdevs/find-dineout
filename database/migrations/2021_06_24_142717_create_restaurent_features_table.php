<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurentFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurent_features', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurent_id');
            $table->unsignedBigInteger('feature_id');
            $table->timestamps();

            $table->foreign('restaurent_id')->references('id')->on('restaurents')->onDelete('cascade');
            $table->foreign('feature_id')->references('id')->on('features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurent_features');
    }
}

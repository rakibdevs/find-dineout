<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurentCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurent_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurent_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('restaurent_id')->references('id')->on('restaurents')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurent_categories');
    }
}

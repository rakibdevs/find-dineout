<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRestaurentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurents', function (Blueprint $table) {
            $table->id();
            $table->string('name',200);
            $table->text('slug');
            $table->integer('approx_cost')->length(8)->unsigned();
            $table->integer('is_booking')->length(1)->default(1)->unsigned();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('restaurents');
    }
}

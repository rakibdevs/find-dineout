<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurent_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('booking_code',10)->unique();
            $table->date('booking_date');
            $table->time('booking_time')->nullable();
            $table->string('guest_name',100)->nullable();
            $table->string('mobile_no',20);
            $table->string('email',100);
            $table->integer('guest_count')->length(5)->default(0)->unsigned();
            $table->integer('status')->length(1)->default(0)->unsigned();
            $table->timestamps();

            $table->foreign('restaurent_id')->references('id')->on('restaurents')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}

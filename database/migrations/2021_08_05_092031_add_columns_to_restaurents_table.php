<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToRestaurentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurents', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->text('address')->nullable();
            $table->integer('status')->length(1)->default(1)->unsigned();
            $table->string('lon',50)->nullable();
            $table->string('lat',50)->nullable();

            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurents', function (Blueprint $table) {
            $table->dropForeign(['address_id']);
            $table->dropColumn('location_id');
            $table->dropColumn('address');
            $table->dropColumn('status');
            $table->dropColumn('lon');
            $table->dropColumn('lat');
        });
    }
}

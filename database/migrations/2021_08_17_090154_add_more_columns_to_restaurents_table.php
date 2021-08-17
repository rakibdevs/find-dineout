<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToRestaurentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurents', function (Blueprint $table) {
            $table->integer('view')->length(1)->default(0)->unsigned();
            $table->string('mobile_no',50)->nullable();
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
            $table->dropColumn('view');
            $table->dropColumn('mobile_no');
        });
    }
}

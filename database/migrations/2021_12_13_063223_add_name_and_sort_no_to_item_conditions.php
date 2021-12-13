<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameAndSortNoToItemConditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_conditions', function (Blueprint $table) {
            //
            $table->string('name');
            $table->integer('sort_no');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_conditions', function (Blueprint $table) {
            //
            $table->dropColumn('name');
            $table->dropColumn('sort_no');
        });
    }
}

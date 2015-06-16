<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Statistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Statistics', function(Blueprint $tbl)
        {
            $tbl->increments('id');
            $tbl->integer('user_id')->nullable();
            $tbl->integer('words_reported')->nullable()->default(0);
            $tbl->integer('words_inserted')->nullable()->default(0);
            $tbl->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Statistics');
    }
}

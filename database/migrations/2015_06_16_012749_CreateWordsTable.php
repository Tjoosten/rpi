<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Words', function(Blueprint $tbl)
        {
            $tbl->increments('id');
            $tbl->integer('user_id')->nullable();
            $tbl->integer('region_id')->nullable();
            $tbl->string('word')->nullable();
            $tbl->string('word_an')->nullable();
            $tbl->string('word_fonetic')->nullable();
            $tbl->string('dialect')->nullable();
            $tbl->text('description')->nullable();
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
        Schema::drop('Words');
    }
}

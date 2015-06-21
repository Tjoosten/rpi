<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Kloekecode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Kloekecode', function(Blueprint $t)
        {
            $t->increments('id');
            $t->string('Kloekecode')->nullable();
            $t->string('Plaats')->nullable();
            $t->string('Gemeente')->nullable();
            $t->string('Provincie')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Kloekecode');
    }
}

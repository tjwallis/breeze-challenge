<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Person extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
      Schema::create('people', function($table) {
        $table->increments('id');
        $table->integer('person_id')->unique();
        $table->integer('group_id')->unique();
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->boolean('status');
        $table->foreign('group_id')->references('group_id')->on('groups');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('people');
    }
}

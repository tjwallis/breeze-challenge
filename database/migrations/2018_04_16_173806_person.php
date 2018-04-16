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
        $table->sting('first_name');
        $table->sting('last_name');
        $table->sting('email');
        $table->foreign('group_id')->references('group_id')->on('groups');
        $table->boolean('status');
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

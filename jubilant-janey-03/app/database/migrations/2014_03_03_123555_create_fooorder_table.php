<?php

use Illuminate\Database\Migrations\Migration;

class CreateFooorderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fooorders', function($table)
        {
            $table->create();
            $table->increments('id');
            $table->string('name');
            $table->integer('quantity');
            $table->string('roomno');
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
		Schema::drop('fooorders');
	}

}
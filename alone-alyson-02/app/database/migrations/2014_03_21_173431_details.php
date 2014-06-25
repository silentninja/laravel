<?php

use Illuminate\Database\Migrations\Migration;

class Details extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('details', function($table)
      {
          $table->increments('id');
          $table->string('gname');
          $table->string('list');
          $table->boolean('status');
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
		//
	}

}
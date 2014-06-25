<?php

use Illuminate\Database\Migrations\Migration;

class CreateplayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('players', function($table)
      {
          $table->increments('id');
          $table->string('name');
          $table->string('type');
          $table->integer('cost');
          $table->integer('score');
          
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
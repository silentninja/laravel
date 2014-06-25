<?php

use Illuminate\Database\Migrations\Migration;

class CreateHusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('husers', function($table)
        {
            $table->create();
            $table->increments('id');
            $table->string('password');
            $table->string('name');
            $table->string('username');
            $table->integer('roomno');
            $table->tinyInteger('active');
            $table->tinyInteger('isadmin');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable = true;
          
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
		Schema::drop('husers');
	}

}
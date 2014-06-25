<?php

use Illuminate\Database\Migrations\Migration;

class CreateResorders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('resorders', function($table)
        {
            $table->create();
            $table->increments('id');
            $table->string('orders');
            $table->string('tablen');
            $table->timestamps();
            $table->softdeletes();
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
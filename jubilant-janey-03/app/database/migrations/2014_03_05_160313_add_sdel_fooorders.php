<?php

use Illuminate\Database\Migrations\Migration;

class AddSdelFooorders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fooorders', function($table)
{
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
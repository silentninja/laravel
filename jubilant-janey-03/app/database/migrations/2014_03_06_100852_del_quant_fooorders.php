<?php

use Illuminate\Database\Migrations\Migration;

class DelQuantFooorders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fooorders', function($table)
{
    $table->dropColumn('name');
    $table->dropColumn('quantity');
    $table->string('orders');
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
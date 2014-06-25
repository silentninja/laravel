<?php

use Illuminate\Database\Migrations\Migration;

class AddRatingNumber extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('items', function($table)
        {
            
            $table->integer('rating');
            $table->integer('no');
         
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
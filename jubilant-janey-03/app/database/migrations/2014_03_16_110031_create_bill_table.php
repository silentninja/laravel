<?php

use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('bill', function($table)
        {
            $table->create();
            $table->increments('id');
            $table->string('table');
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
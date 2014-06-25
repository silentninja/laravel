<?php

use Illuminate\Database\Migrations\Migration;

class CreateBillhistory extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('billhistory', function($table)
        {
            $table->create();
            $table->increments('id');
            $table->string('orders');
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
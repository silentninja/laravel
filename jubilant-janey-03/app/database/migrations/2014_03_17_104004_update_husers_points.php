<?php

use Illuminate\Database\Migrations\Migration;

class UpdateHusersPoints extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('husers', function($table)
        {
           
            $table->integer('points');
            $table->string('history');
            
          
        });
		Huser::create(array(

'username' =>'mukesh','name'=>'mukesh','password' => Hash::make('19950000'),'active'=>1,'isadmin'=>1)
);
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
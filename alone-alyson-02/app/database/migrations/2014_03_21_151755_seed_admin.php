<?php

use Illuminate\Database\Migrations\Migration;

class SeedAdmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
      {
        
          $table->boolean('isadmin');
          
      });
		 User::create(array(

'email' =>'mukesh','name'=>'mukesh','password' => Hash::make('123'),'isadmin'=>1)
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
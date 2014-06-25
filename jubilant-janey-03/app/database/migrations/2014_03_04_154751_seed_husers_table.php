<?php

use Illuminate\Database\Migrations\Migration;

class SeedHusersTable extends Migration {

  public function up()
        {
                Huser::create(array(

'username' =>'coolt','name'=>'you','password' => Hash::make('cooltre'),'active'=>1,'isadmin'=>1)
);
        }

        public function down()
        {
                DB::table('husers')->delete();
        }

}
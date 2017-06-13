<?php

use Illuminate\Database\Seeder;

class UserAdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array('id'=>1,'nome'=>'Marco','cognome'=>'Tortora','username'=>'developer','password'=>bcrypt("admincaf"),'idRuolo'=>3,'caf_id'=>1),
        ));
    }
}

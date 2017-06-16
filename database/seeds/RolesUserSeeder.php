<?php

use Illuminate\Database\Seeder;

class RolesUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('RolesUser')->delete();
        DB::table('RolesUser')->insert(array(
            array('id'=>1,'descrizione'=>'Supervisore'),
            array('id'=>2,'descrizione'=>'Operatore'),
            array('id'=>3,'descrizione'=>'Super Admin'),
        ));
    }
}

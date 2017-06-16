<?php

use Illuminate\Database\Seeder;

class TipologiaClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TipologiaCliente')->delete();
        DB::table('TipologiaCliente')->insert(array(
            array('id'=>'1','descrizione'=>'Persona Fisica'),
            array('id'=>'2','descrizione'=>'Persona Giuridica'),
        ));
    }
}

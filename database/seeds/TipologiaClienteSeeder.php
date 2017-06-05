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
        DB::table('TipologiaCliente')->insert(array(
            array('descrizione'=>'Persona Fisica'),
            array('descrizione'=>'Persona Giuridica'),
        ));
    }
}

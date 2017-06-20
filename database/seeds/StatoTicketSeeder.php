<?php

use Illuminate\Database\Seeder;

class StatoTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stato_ticket')->delete();
        DB::table('stato_ticket')->insert(array(
            array('id'=>1,'nome'=> 'In attesa della documentazione'),
            array('id'=>2,'nome'=> 'Pronto per la presa in carico'),
            array('id'=>3,'nome'=>'Completato'),
        ));
    }
}

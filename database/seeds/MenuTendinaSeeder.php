<?php

use Illuminate\Database\Seeder;

class MenuTendinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('TipiDocumentiIdentita')->delete();
        DB::table('TipiDocumentiIdentita')->insert(array(
            array('id'=>1,'descrizione'=>'Nessuno')
        ));

        DB::table('TipoInvalidita')->delete();
        DB::table('TipoInvalidita')->insert(array(
            array('id'=>1,'invalidita'=>'Nessuna')
        ));

        DB::table('TipoProfessione')->delete();
        DB::table('TipoProfessione')->insert(array(
            array('id'=>1,'professione'=>'Nessuna')
        ));

        DB::table('TitoloStudio')->delete();
        DB::table('TitoloStudio')->insert(array(
            array('id'=>1,'titolo'=>'Nessuno')
        ));
    }
}

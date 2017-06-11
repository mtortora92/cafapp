<?php

use Illuminate\Database\Seeder;

class ComuniSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // exec("mysql -u root -p 13marco292 CAF_la_galleria_dei_servizi < ./resources/assets/TabellaComuni.sql");
        DB::table('Comuni')->insert(array(
            array('id'=>1,'comune'=>'Napoli','regione'=>'Campania','provincia'=>'NA','cap'=>'80121-80147'),
            array('id'=>2,'comune'=>'Roma','regione'=>'Lazio','provincia'=>'RM','cap'=>'00118-00199'),
            array('id'=>3,'comune'=>'Milano','regione'=>'Lombardia','provincia'=>'MI','cap'=>'20121-20162'),
        ));
    }
}

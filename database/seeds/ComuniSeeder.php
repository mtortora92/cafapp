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
        exec("mysql -u root -p 13marco292 CAF_la_galleria_dei_servizi < ./resources/assets/TabellaComuni.sql");
    }
}

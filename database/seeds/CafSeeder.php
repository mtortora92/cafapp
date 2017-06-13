<?php

use Illuminate\Database\Seeder;

class CafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('caf')->insert(array(
                array('id'=>1,'nome'=>'La galleria dei servizi'),
            ));
        }
    }
}

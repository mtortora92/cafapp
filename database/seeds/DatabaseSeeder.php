<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesUserSeeder::class);
        $this->call(CafSeeder::class);
        $this->call(UserAdministratorSeeder::class);
        $this->call(TipologiaClienteSeeder::class);
        $this->call(MenuTendinaSeeder::class);
        $this->call(ComuniTableSeeder::class);
    }
}

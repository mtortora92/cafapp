<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAltreInfoClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('AltreInfoCliente', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idTitoloStudio')->unsigned()->index('fk_AltreInfoCliente_TitoloStudio1_idx');
			$table->integer('idProfessione')->unsigned()->index('fk_AltreInfoCliente_TipoProfessione1_idx');
			$table->string('telefono')->default('');
			$table->string('cellulare')->default('');
			$table->string('email')->default('');
			$table->string('numTesseraEnotria')->default('');
			$table->boolean('socio');
			$table->boolean('delegaSindacale');
			$table->boolean('socioEnotriaCral');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('AltreInfoCliente');
	}

}

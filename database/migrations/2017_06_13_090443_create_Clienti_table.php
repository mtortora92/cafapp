<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Clienti', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idAnagrafica')->unsigned()->index('fk_Clienti_AnagraficheClienti1_idx');
			$table->integer('idInvalidita')->unsigned()->index('fk_Clienti_Invalidita1_idx');
			$table->integer('idDocumentoIdentita')->unsigned()->index('fk_Clienti_DocumentoIdentita1_idx');
			$table->integer('idAltreInfo')->unsigned()->index('fk_Clienti_AltreInfoCliente1_idx');
			$table->integer('caf_id')->unsigned()->index('fk_Clienti_caf1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Clienti');
	}

}

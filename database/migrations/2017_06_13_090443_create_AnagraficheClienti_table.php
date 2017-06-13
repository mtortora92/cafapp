<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnagraficheClientiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('AnagraficheClienti', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idTipologiaCliente')->unsigned()->index('fk_AnagraficheClienti_TipologiaCliente1_idx');
			$table->string('cognome')->default('');
			$table->string('nome')->default('');
			$table->string('sesso')->default('');
			$table->date('dataNascita')->nullable();
			$table->integer('luogoNascita')->nullable()->index('fk_AnagraficheClienti_Comuni1_idx');
			$table->string('codiceFiscale')->default('');
			$table->string('partitaIva')->default('');
			$table->string('pinInps')->default('');
			$table->string('indirizzoResidenza')->default('');
			$table->integer('comuneResidenza')->nullable()->index('fk_AnagraficheClienti_Comuni2_idx');
            $table->string('capResidenza')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('AnagraficheClienti');
	}

}

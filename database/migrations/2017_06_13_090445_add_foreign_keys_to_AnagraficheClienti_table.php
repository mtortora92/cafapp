<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnagraficheClientiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('AnagraficheClienti', function(Blueprint $table)
		{
			$table->foreign('idTipologiaCliente', 'fk_AnagraficheClienti_TipologiaCliente1')->references('id')->on('TipologiaCliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('luogoNascita', 'fk_AnagraficheClienti_Comuni1')->references('id')->on('Comuni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('comuneResidenza', 'fk_AnagraficheClienti_Comuni2')->references('id')->on('Comuni')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('AnagraficheClienti', function(Blueprint $table)
		{
			$table->dropForeign('fk_AnagraficheClienti_TipologiaCliente1');
			$table->dropForeign('fk_AnagraficheClienti_Comuni1');
			$table->dropForeign('fk_AnagraficheClienti_Comuni2');
		});
	}

}

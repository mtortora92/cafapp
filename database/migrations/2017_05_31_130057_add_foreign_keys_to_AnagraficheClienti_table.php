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
		});
	}

}

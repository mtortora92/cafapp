<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAltreInfoClienteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('AltreInfoCliente', function(Blueprint $table)
		{
			$table->foreign('idProfessione', 'fk_AltreInfoCliente_TipoProfessione1')->references('id')->on('TipoProfessione')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idTitoloStudio', 'fk_AltreInfoCliente_TitoloStudio1')->references('id')->on('TitoloStudio')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('AltreInfoCliente', function(Blueprint $table)
		{
			$table->dropForeign('fk_AltreInfoCliente_TipoProfessione1');
			$table->dropForeign('fk_AltreInfoCliente_TitoloStudio1');
		});
	}

}

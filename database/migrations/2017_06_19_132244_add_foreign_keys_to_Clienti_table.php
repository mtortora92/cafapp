<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToClientiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Clienti', function(Blueprint $table)
		{
			$table->foreign('idAltreInfo', 'fk_Clienti_AltreInfoCliente1')->references('id')->on('AltreInfoCliente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idAnagrafica', 'fk_Clienti_AnagraficheClienti1')->references('id')->on('AnagraficheClienti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idDocumentoIdentita', 'fk_Clienti_DocumentoIdentita1')->references('id')->on('DocumentoIdentita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('idInvalidita', 'fk_Clienti_Invalidita1')->references('id')->on('Invalidita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('caf_id', 'fk_Clienti_caf1')->references('id')->on('caf')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Clienti', function(Blueprint $table)
		{
			$table->dropForeign('fk_Clienti_AltreInfoCliente1');
			$table->dropForeign('fk_Clienti_AnagraficheClienti1');
			$table->dropForeign('fk_Clienti_DocumentoIdentita1');
			$table->dropForeign('fk_Clienti_Invalidita1');
			$table->dropForeign('fk_Clienti_caf1');
		});
	}

}

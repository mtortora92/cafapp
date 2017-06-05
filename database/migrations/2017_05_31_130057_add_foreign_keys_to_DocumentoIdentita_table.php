<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentoIdentitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('DocumentoIdentita', function(Blueprint $table)
		{
			$table->foreign('idTipoDocumento', 'fk_DocumentoIdentita_TipiDocumentiIdentita1')->references('id')->on('TipiDocumentiIdentita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('DocumentoIdentita', function(Blueprint $table)
		{
			$table->dropForeign('fk_DocumentoIdentita_TipiDocumentiIdentita1');
		});
	}

}

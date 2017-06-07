<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoIdentitaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('DocumentoIdentita', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idTipoDocumento')->unsigned()->index('fk_DocumentoIdentita_TipiDocumentiIdentita1_idx');
			$table->date('dataRilascio')->nullable();
			$table->date('dataScadenza')->nullable();
			$table->integer('rilasciatoDa')->nullable()->index('fk_DocumentoIdentita_Comuni1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('DocumentoIdentita');
	}

}

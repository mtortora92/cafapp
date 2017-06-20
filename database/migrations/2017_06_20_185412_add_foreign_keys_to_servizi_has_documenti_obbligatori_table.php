<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToServiziHasDocumentiObbligatoriTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servizi_has_documenti_obbligatori', function(Blueprint $table)
		{
			$table->foreign('servizi_id', 'fk_servizi_has_documenti_servizi_servizi1')->references('id')->on('servizi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('documenti_servizi_id', 'fk_servizi_has_documenti_servizi_documenti_servizi1')->references('id')->on('documenti_servizi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servizi_has_documenti_obbligatori', function(Blueprint $table)
		{
			$table->dropForeign('fk_servizi_has_documenti_servizi_servizi1');
			$table->dropForeign('fk_servizi_has_documenti_servizi_documenti_servizi1');
		});
	}

}

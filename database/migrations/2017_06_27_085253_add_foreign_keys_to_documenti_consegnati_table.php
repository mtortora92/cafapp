<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentiConsegnatiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documenti_consegnati', function(Blueprint $table)
		{
			$table->foreign('clienti_id', 'fk_documenti_consegnati_Clienti1')->references('id')->on('Clienti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('documenti_servizi_id', 'fk_documenti_consegnati_documenti_servizi1')->references('id')->on('documenti_servizi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_documenti_consegnati_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documenti_consegnati', function(Blueprint $table)
		{
			$table->dropForeign('fk_documenti_consegnati_Clienti1');
			$table->dropForeign('fk_documenti_consegnati_documenti_servizi1');
			$table->dropForeign('fk_documenti_consegnati_users1');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->foreign('clienti_id', 'fk_ticket_Clienti1')->references('id')->on('Clienti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('servizi_id', 'fk_ticket_servizi1')->references('id')->on('servizi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ticket', function(Blueprint $table)
		{
			$table->dropForeign('fk_ticket_Clienti1');
			$table->dropForeign('fk_ticket_servizi1');
		});
	}

}

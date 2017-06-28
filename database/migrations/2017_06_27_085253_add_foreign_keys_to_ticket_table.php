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
			$table->foreign('utente_per_lavorazione', 'fk_ticket_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('stato_ticket_id', 'fk_ticket_stato_ticket1')->references('id')->on('stato_ticket')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inserito_da', 'fk_ticket_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
			$table->dropForeign('fk_ticket_users1');
			$table->dropForeign('fk_ticket_stato_ticket1');
			$table->dropForeign('fk_ticket_users2');
		});
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ticket', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('importo', 10, 0)->nullable();
			$table->date('data_chiusura')->nullable();
			$table->integer('clienti_id')->unsigned()->index('fk_ticket_Clienti1_idx');
			$table->integer('servizi_id')->index('fk_ticket_servizi1_idx');
			$table->text('note', 65535);
			$table->integer('utente_per_lavorazione')->unsigned()->nullable()->index('fk_ticket_users1_idx');
			$table->integer('stato_ticket_id')->index('fk_ticket_stato_ticket1_idx');
			$table->timestamps();
			$table->integer('inserito_da')->unsigned()->index('fk_ticket_users2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ticket');
	}

}

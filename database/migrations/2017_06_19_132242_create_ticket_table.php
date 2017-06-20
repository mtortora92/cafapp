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
			$table->decimal('sconto', 10, 0)->nullable();
			$table->date('data_chiusura')->nullable();
			$table->text('note')->default('');
			$table->integer('utente_per_lavorazione')->nullable();
			$table->integer('clienti_id')->unsigned()->index('fk_ticket_Clienti1_idx');
			$table->integer('servizi_id')->index('fk_ticket_servizi1_idx');
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

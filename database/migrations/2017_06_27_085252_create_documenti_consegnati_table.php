<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentiConsegnatiTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documenti_consegnati', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('path')->nullable();
			$table->integer('clienti_id')->unsigned()->index('fk_documenti_consegnati_Clienti1_idx');
			$table->integer('documenti_servizi_id')->index('fk_documenti_consegnati_documenti_servizi1_idx');
			$table->integer('users_id')->unsigned()->index('fk_documenti_consegnati_users1_idx');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documenti_consegnati');
	}

}

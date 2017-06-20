<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiziHasDocumentiObbligatoriTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('servizi_has_documenti_obbligatori', function(Blueprint $table)
		{
			$table->integer('servizi_id')->index('fk_servizi_has_documenti_servizi_servizi1_idx');
			$table->integer('documenti_servizi_id')->index('fk_servizi_has_documenti_servizi_documenti_servizi1_idx');
			$table->integer('id', true);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('servizi_has_documenti_obbligatori');
	}

}

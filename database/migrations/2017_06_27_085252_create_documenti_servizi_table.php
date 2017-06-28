<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentiServiziTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documenti_servizi', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nome', 100)->default('');
			$table->string('descrizione')->default('');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documenti_servizi');
	}

}

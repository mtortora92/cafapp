<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentiOutputTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documenti_output', function(Blueprint $table)
		{
			$table->integer('id',true)->primary();
			$table->string('path')->nullable();
			$table->integer('ticket_id')->index('fk_documenti_output_ticket1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('documenti_output');
	}

}

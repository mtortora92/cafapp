<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentiOutputTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documenti_output', function(Blueprint $table)
		{
			$table->foreign('ticket_id', 'fk_documenti_output_ticket1')->references('id')->on('ticket')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documenti_output', function(Blueprint $table)
		{
			$table->dropForeign('fk_documenti_output_ticket1');
		});
	}

}

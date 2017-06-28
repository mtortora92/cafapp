<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToServiziTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('servizi', function(Blueprint $table)
		{
			$table->foreign('gruppi_servizi_id', 'fk_servizi_gruppi_servizi1')->references('id')->on('gruppi_servizi')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('servizi', function(Blueprint $table)
		{
			$table->dropForeign('fk_servizi_gruppi_servizi1');
		});
	}

}

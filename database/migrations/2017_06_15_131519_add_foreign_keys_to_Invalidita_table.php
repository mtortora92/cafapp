<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInvaliditaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Invalidita', function(Blueprint $table)
		{
			$table->foreign('idInvalidita', 'fk_Invalidita_TipoInvalidita')->references('id')->on('TipoInvalidita')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Invalidita', function(Blueprint $table)
		{
			$table->dropForeign('fk_Invalidita_TipoInvalidita');
		});
	}

}

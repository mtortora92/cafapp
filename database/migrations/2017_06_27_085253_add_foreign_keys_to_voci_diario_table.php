<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToVociDiarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('voci_diario', function(Blueprint $table)
		{
			$table->foreign('clienti_id', 'fk_voci_diario_Clienti1')->references('id')->on('Clienti')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('users_id', 'fk_voci_diario_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('voci_diario', function(Blueprint $table)
		{
			$table->dropForeign('fk_voci_diario_Clienti1');
			$table->dropForeign('fk_voci_diario_users1');
		});
	}

}

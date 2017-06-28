<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVociDiarioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('voci_diario', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('descrizione', 45)->default('');
			$table->integer('clienti_id')->unsigned()->index('fk_voci_diario_Clienti1_idx');
			$table->timestamps();
			$table->integer('users_id')->unsigned()->index('fk_voci_diario_users1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voci_diario');
	}

}

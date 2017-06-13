<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvaliditaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Invalidita', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idInvalidita')->unsigned()->nullable()->index('fk_Invalidita_TipoInvalidita_idx');
			$table->string('percentuale')->default('');
			$table->boolean('accompagnamento')->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Invalidita');
	}

}

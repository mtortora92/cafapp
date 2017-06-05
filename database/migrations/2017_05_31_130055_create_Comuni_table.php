<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComuniTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Comuni', function(Blueprint $table)
		{
			$table->integer('id_citta');
			$table->string('comune')->nullable();
			$table->string('regione', 50)->nullable();
			$table->string('provincia', 2)->nullable();
			$table->char('cap', 11)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Comuni');
	}

}

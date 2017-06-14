<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nome', 191);
			$table->string('cognome', 191);
			$table->string('username', 191);
			$table->string('password', 191);
			$table->integer('idRuolo')->unsigned()->index('fk_users_RolesUser1_idx');
			$table->boolean('isValid')->default(1);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->integer('caf_id')->unsigned()->index('fk_users_caf1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}

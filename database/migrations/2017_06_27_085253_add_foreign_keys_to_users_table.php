<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->foreign('idRuolo', 'fk_users_RolesUser1')->references('id')->on('RolesUser')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('caf_id', 'fk_users_caf1')->references('id')->on('caf')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table)
		{
			$table->dropForeign('fk_users_RolesUser1');
			$table->dropForeign('fk_users_caf1');
		});
	}

}

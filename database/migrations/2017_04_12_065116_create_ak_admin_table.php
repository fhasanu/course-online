<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAkAdminTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ak_admin', function(Blueprint $table)
		{
			$table->integer('ak_admin_id', true);
			$table->string('ak_admin_username', 45)->unique();
			$table->string('ak_admin_password', 45);
			$table->timestamps('ak_admin_last_activity');
            $table->rememberToken();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ak_admin');
	}

}

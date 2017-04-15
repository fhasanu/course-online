<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAkUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ak_user', function(Blueprint $table)
		{
			$table->integer('ak_user_id', true);
			$table->string('ak_user_firstname');
			$table->string('ak_user_lastname');
			$table->string('ak_user_email')->unique();
			$table->string('ak_user_password');
			$table->date('ak_user_dob');
			$table->integer('ak_user_phone');
            $table->rememberToken();
            $table->timestamps();

		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ak_user');
	}

}

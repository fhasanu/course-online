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
			$table->integer('id', true);
			$table->string('firstname');
			$table->string('lastname');
			$table->string('email')->unique();
			$table->string('password');
			$table->date('dob');
			$table->integer('phone');
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {
	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255)->unique();
			$table->string('phone', 255);
			$table->string('password', 255);
			$table->bigInteger('city_id')->unsigned();
			$table->date('birth_date');
			$table->date('last_donate_date');
			$table->bigInteger('blood_type_id')->unsigned();
			$table->string('pin_code', 255)->nullable()->unique();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}

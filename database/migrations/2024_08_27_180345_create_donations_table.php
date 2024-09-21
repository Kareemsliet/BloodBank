<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationsTable extends Migration {

	public function up()
	{
		Schema::create('donations', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->integer('age');
			$table->bigInteger('blood_type_id')->unsigned();
			$table->bigInteger('city_id')->unsigned();
			$table->string('phone', 255);
			$table->text('description')->nullable();
			$table->string('hospital_adress', 255)->nullable();
			$table->integer('num_bags');
			$table->bigInteger('client_id')->unsigned();
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('donations');
	}
}

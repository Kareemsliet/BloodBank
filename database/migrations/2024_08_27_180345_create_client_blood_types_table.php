<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('client_blood_types', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('blood_type_id')->unsigned();
			$table->bigInteger('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_blood_types');
	}
}

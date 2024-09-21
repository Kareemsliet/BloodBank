<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatesTable extends Migration {

	public function up()
	{
		Schema::create('states', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->string('code', 255);
		});
	}

	public function down()
	{
		Schema::drop('states');
	}
}

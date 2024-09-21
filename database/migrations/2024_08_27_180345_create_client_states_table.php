<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientStatesTable extends Migration {

	public function up()
	{
		Schema::create('client_states', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('state_id')->unsigned();
			$table->bigInteger('client_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_states');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('phone', 255);
			$table->string('email', 255);
			$table->string('title', 255);
			$table->text('description')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}

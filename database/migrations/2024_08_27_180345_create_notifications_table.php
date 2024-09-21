<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->bigInteger('donation_id')->unsigned()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}

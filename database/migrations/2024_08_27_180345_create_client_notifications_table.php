<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('client_notifications', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('client_id')->unsigned();
			$table->timestamp('read_at')->nullable();
			$table->bigInteger('notification_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_notifications');
	}
}

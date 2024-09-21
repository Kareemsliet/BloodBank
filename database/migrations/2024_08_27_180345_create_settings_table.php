<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name', 255);
			$table->string('logo', 255);
			$table->string('email', 255);
			$table->string('phone', 255);
			$table->text('description');
			$table->string('adress', 255)->nullable();
			$table->string('facebook_link', 255)->nullable();
			$table->string('twitter_link', 255)->nullable();
			$table->string('youtube_link', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}

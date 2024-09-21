<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHeroPagesTable extends Migration {

	public function up()
	{
		Schema::create('hero_pages', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('image', 255);
			$table->text('des');
			$table->string('title', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('hero_pages');
	}
}

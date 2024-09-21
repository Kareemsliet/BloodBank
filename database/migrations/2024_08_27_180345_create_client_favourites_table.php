<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientFavouritesTable extends Migration {

	public function up()
	{
		Schema::create('client_favourites', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->bigInteger('client_id')->unsigned();
			$table->bigInteger('article_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('client_favourites');
	}
}

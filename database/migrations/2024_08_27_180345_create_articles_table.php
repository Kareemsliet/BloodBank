<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArticlesTable extends Migration {

	public function up()
	{
		Schema::create('articles', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('title', 255);
            $table->bigInteger('cat_id')->unsigned();
			$table->text('description');
			$table->string('image', 255);
		});
	}

	public function down()
	{
		Schema::drop('articles');
	}
}

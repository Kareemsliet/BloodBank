<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('cities', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});

        Schema::table('articles', function(Blueprint $table) {
			$table->foreign('cat_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('restrict');
		});

		Schema::table('clients', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('city_id')->references('id')->on('cities')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_favourites', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_favourites', function(Blueprint $table) {
			$table->foreign('article_id')->references('id')->on('articles')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_notifications', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_notifications', function(Blueprint $table) {
			$table->foreign('notification_id')->references('id')->on('notifications')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_blood_types', function(Blueprint $table) {
			$table->foreign('blood_type_id')->references('id')->on('blood_types')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_blood_types', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_states', function(Blueprint $table) {
			$table->foreign('state_id')->references('id')->on('states')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('client_states', function(Blueprint $table) {
			$table->foreign('client_id')->references('id')->on('clients')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('cities', function(Blueprint $table) {
			$table->dropForeign('cities_state_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_city_id_foreign');
		});
		Schema::table('clients', function(Blueprint $table) {
			$table->dropForeign('clients_blood_type_id_foreign');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_blood_type_id_foreign');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_city_id_foreign');
		});
		Schema::table('donations', function(Blueprint $table) {
			$table->dropForeign('donations_client_id_foreign');
		});
		Schema::table('client_favourites', function(Blueprint $table) {
			$table->dropForeign('client_favourites_client_id_foreign');
		});
		Schema::table('client_favourites', function(Blueprint $table) {
			$table->dropForeign('client_favourites_article_id_foreign');
		});
		Schema::table('client_notifications', function(Blueprint $table) {
			$table->dropForeign('client_notifications_client_id_foreign');
		});
		Schema::table('client_notifications', function(Blueprint $table) {
			$table->dropForeign('client_notifications_notification_id_foreign');
		});
		Schema::table('client_blood_types', function(Blueprint $table) {
			$table->dropForeign('client_blood_types_blood_type_id_foreign');
		});
		Schema::table('client_blood_types', function(Blueprint $table) {
			$table->dropForeign('client_blood_types_client_id_foreign');
		});
		Schema::table('client_states', function(Blueprint $table) {
			$table->dropForeign('client_states_state_id_foreign');
		});
		Schema::table('client_states', function(Blueprint $table) {
			$table->dropForeign('client_states_client_id_foreign');
		});
	}
}

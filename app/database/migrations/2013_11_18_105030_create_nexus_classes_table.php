<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNexusClassesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nexus_classes', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('year_id')->unsigned();
			$table->foreign('year_id')->references('id')->on('years');
			$table->integer('nexus_class_type_id')->unsigned();
			$table->foreign('nexus_class_type_id')->references('id')->on('nexus_class_types');
			$table->string('description');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('nexus_classes');
	}

}

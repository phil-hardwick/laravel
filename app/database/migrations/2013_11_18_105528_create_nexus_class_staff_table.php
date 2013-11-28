<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNexusClassStaffTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nexus_class_staff', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('nexus_class_id')->unsigned();
			$table->foreign('nexus_class_id')->references('id')->on('nexus_classes');
			$table->integer('staff_id')->unsigned();
			$table->foreign('staff_id')->references('id')->on('staffs');
			$table->primary(array('staff_id', 'nexus_class_id'));
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
		Schema::drop('nexus_class_staff');
	}

}

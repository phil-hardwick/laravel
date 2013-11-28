<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('register', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->datetime('time_registered');
			$table->integer('registered_state_id')->unsigned();
			$table->foreign('registered_state_id')->references('id')->on('registered_states');
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('students');
			$table->integer('staff_id')->unsigned();
			$table->foreign('staff_id')->references('id')->on('staffs');
			$table->integer('nexus_class_id')->unsigned();
			$table->foreign('nexus_class_id')->references('id')->on('nexus_classes');
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
		Schema::drop('register');
	}

}

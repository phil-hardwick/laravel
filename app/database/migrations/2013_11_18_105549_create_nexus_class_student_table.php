<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNexusClassStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('nexus_class_student', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('nexus_class_id')->unsigned();
			$table->foreign('nexus_class_id')->references('id')->on('nexus_classes');
			$table->integer('student_id')->unsigned();
			$table->foreign('student_id')->references('id')->on('students');
			$table->primary(array('student_id', 'nexus_class_id'));
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
		Schema::drop('nexus_class_student');
	}

}

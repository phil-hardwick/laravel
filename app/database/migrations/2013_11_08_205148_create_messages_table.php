<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->integer('certificate_id')->unsigned();
			$table->foreign('certificate_id')->references('id')->on('certificates');
			$table->integer('device_id')->unsigned();
			$table->foreign('device_id')->references('id')->on('devices');
			$table->string('message', 250);
			$table->string('sound', 100)->nullable();
			$table->string('data', 250)->nullable();
			$table->integer('badge')->nullable();
			$table->smallInteger('status')->default(0);
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
		Schema::drop('messages');
	}

}

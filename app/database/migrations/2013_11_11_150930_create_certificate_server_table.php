<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificateServerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificate_server', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->integer('certificate_id')->unsigned();
			$table->foreign('certificate_id')->references('id')->on('certificates');
			$table->integer('server_id')->unsigned();
			$table->foreign('server_id')->references('id')->on('servers');
			$table->primary(array('server_id', 'certificate_id'));
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
		Schema::drop('certificate_server');
	}

}

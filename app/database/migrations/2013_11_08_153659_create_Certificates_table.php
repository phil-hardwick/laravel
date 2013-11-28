<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('certificates', function(Blueprint $table)
		{
			$table->engine = 'InnoDB';
			$table->increments('id');
			$table->string('certificate_name', 200);
			$table->integer('ios_app_id')->unsigned();
			$table->foreign('ios_app_id')->references('id')->on('ios_apps');
			$table->string('key_cert_file', 100);
			$table->string('passphrase', 100);
			$table->integer('certificate_type_id')->unsigned();
			$table->foreign('certificate_type_id')->references('id')->on('certificate_types');
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
		Schema::drop('certificates');
	}

}

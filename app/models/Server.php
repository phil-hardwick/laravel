<?php


class Server extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'servers';
	
	public function Certificates() {
		return $this->belongsToMany('Certificate');
	}

}
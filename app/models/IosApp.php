<?php


class IosApp extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ios_apps';
	
	public function devices() {
		return $this->belongsToMany('Device');
	}

}
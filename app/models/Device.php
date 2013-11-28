<?php

class Device extends Eloquent {

	protected $table = 'devices';
	
	public function user() {
		return $this->belongsTo('User');
	}
	
	public function iosApps() {
		return $this->belongsToMany('IosApp');
	}

}
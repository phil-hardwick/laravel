<?php


class Staff extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'staffs';
	
	public function user() {
			return $this->belongsTo('User');
	}
	
	public function nexusClasses() {
			return $this->belongsToMany('NexusClass');
	}

}
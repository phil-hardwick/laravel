<?php


class Student extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'students';
	
	public function nexusClasses() {
			return $this->belongsToMany('NexusClass');
	}

}
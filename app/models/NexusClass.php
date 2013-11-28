<?php


class NexusClass extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'nexus_classes';
	
	public function year() {
			return $this->hasOne('Year');
	}
	
	public function nexusClassType() {
			return $this->hasOne('NexusClassType');
	}
	
	public function students() {
			return $this->belongsToMany('Student');
	}
	
	public function staffs() {
			return $this->belongsToMany('Staff');
	}

}
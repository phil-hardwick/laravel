<?php


class RegisterEntry extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'register';
	
	protected $fillable = array('registered_state_id', 'student_id', 'nexus_class_id', 'staff_id', 'time_registered');
	
	public function registeredState() {
			return $this->hasOne('RegisteredState');
	}
	
	public function student() {
			return $this->hasOne('Student');
	}
	
	public function nexusClass() {
			return $this->hasOne('NexusClass');
	}
	
	public function staff() {
			return $this->hasOne('User');
	}
	
	public function getDates() {
			return array('created_at', 'updated_at');
	}

}
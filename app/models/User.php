<?php


class User extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	
	public function roles() {
			return $this->belongsToMany('Role');
	}
	
// 	public function staff() {
// 			return $this->hasOne('Staff');
// 	}
// 	
// 	public function student() {
// 			return $this->hasOne('Student');
// 	}

}
<?php


class AppDeviceSubscription extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'app_device_subscriptions';
	
	public function device() {
		return $this->hasOne('Device');
	}
	
	public function appSubscription() {
		return $this->hasOne('AppSubscription');
	}

}
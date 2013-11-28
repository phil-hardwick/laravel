<?php


class AppSubscription extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'app_subscriptions';
	
	public function iosApp() {
		return $this->hasOne('IosApp');
	}

}
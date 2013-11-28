<?php


class Certificate extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'certificates';
	
	public function iosApp() {
		return $this->hasOne('IosApp');
	}
	
	public function certificateType() {
		return $this->hasOne('CertificateType');
	}
	
	public function servers() {
		return $this->belongsToMany('Server');
	}

}
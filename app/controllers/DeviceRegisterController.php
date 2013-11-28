<?php

class DeviceRegisterController extends BaseController {

    /**
     * Register Device. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function getIndex()
    {
    		//Is the user trying to gain registered access a person we know about i.e. we have their apple id.
				$user = User::where('apple_id', '=', Input::get('apple_id'))->firstOrFail();
				//Do they already have a device registered? then they shouldn't be here.
				if ($user->api_key != NULL) {
						return Response::make('', 404);
				} else {
						$deviceToken = Input::get('device_token');
						$device = new Device();
						$isTokenValid = $this->isTokenValid($deviceToken);
        		if(!$isTokenValid){
            		return false;
        		}
						$device->device_token = $deviceToken;
						$api_key = $this->makeKey();
						$user->api_key = $api_key;
						$user->is_authenticated = true;
						$user->save();
						$device->user()->associate($user);
						$device->save();
						
						$iosApp = IosApp::where('ios_app_bundle_identifier', '=', 'com.nexanapps.Nexus-Hub')->firstOrFail();
						$iosApp->devices()->save($device);
						
						$apnController = new APNController();
						$apnController->addSingleMessage($deviceToken, "Successfully Registered", $api_key);
				}
    }
    
    private function isTokenValid($deviceToken) {
    		//TODO validate token
    		return true;
    }
    
    function makeKey($bit_length = 256){
				$fp = @fopen('/dev/random','rb');
				if ($fp !== FALSE) {
						$key = substr(base64_encode(@fread($fp,($bit_length + 7) / 8)), 0, (($bit_length + 5) / 6)  - 2);
						@fclose($fp);
						return $key;
				}
				return null;
		}

}
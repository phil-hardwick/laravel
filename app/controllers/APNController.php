<?php

class APNController extends BaseController {
		
		protected $iosApp;
		
		public function __construct() {
				$this->iosApp = IosApp::where('ios_app_bundle_identifier', '=', $this->appName)->first();
		}

    public function postMessage() {
				$this->queueMessage(Input::get('device_token'), Input::get('message'), Input::get('data'));
		}
	
	
    private function queueMessage($deviceToken, $message, $data)
    {
        $pushMessage = new Message();
				$pushMessage->message = $message;
				$pushMessage->data = $data;
				$pushMessage->badge = NULL;
				$pushMessage->sound = NULL;
				$device = Device::where('device_token', '=', $deviceToken)->first();
				$pushMessage->device_id = $device->id;
				$certificate = Certificate::where('ios_app_id', '=', $this->iosApp->id)->first();
				$pushMessage->certificate_id = $certificate->id;
				$pushMessage->save();
    }
    
    public function addSingleMessage($deviceToken, $message, $data) {
    		$this->queueMessage($deviceToken, $message, $data);
    }
    
    public function addMessagesToManyDevices() {
    
    }
    
    public function addMessagesToAllDevices($message, $data) {
    		$appDevices = AppDevices::where('ios_app_id', '=', $this->iosApp->id)->get();
    		foreach ($appDevices as $appDevice) {
    				$device = Device::where('id', '=', $appDevice->device_id);
    				$this->queueMessage($device->token, $message, $data);
    		}
    }
    
    public function addSingleMessageWithData() {
    
    }

}
<?php

class RegisterController extends BaseController {

    /**
     * Post register entries. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function postRegisterEntries()
    {
    		$today = new Datetime('today');
    		$nexusClassId = Input::get('nexus_class_id');
    		$registerEntries = Input::get('register_entries');
    		$success = array();
    		foreach ($registerEntries as $registerEntry) {
    				$id = RegisterEntry::create(array('time_registered' => $today->format('Y-m-d H:i:s'), 
    					'nexus_class_id' => $nexusClassId, 
    					'student_id' => $registerEntry['student_id'],
    					'registered_state_id' => RegisteredState::where('registered_state_name', '=', $registerEntry['registered_state_name'])->first()->id,
    					'staff_id' => Staff::where('user_id', '=', User::where('api_key', '=', Input::get('api_key'))->first()->id)->first()->id));
    				$success[] = $id;
    		}
    		if (count($success) == count($registerEntries)) {
    				return Response::json(array('Response' => 'All students successfully registered'));
    		} else if (count($success) > 0) {
    				return Response::json(array('Response' => 'Some students were not registered, contact system admin to troubleshoot'));
    		} else {
    				return Response::json(array('Response' => 'No Students were registered, contact system admin to troubleshoot'));
    		}
    }
    
    /**
     * Register Device. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function getRegisterEntries()
    {
    		$registerEntriesTodayForClass = RegisterEntry::where('time_registered', '>=', date('Y-m-d'))->where('nexus_class_id', '=', Input::get('nexus_class_id'))->get();
    		$studentsAndRegisteredStatus = array();
    		foreach($registerEntriesTodayForClass as $registerEntry) {
    				$studentsAndRegisteredStatus[] = array('student_id' => $registerEntry->student_id, 
    						'registered_state_name' => RegisteredState::find($registerEntry->registered_state_id)->registered_state_name);
    		}
    		return Response::json($studentsAndRegisteredStatus);
    }
    
    public function getRegisteredStates()
    {
    		$registeredStates = RegisteredState::all();
    		$registeredStateNames = array();
    		foreach($registeredStates as $registeredState) {
    				$registeredStateNames[] = $registeredState->registered_state_name;
    		}
    		return Response::json($registeredStateNames);
    }

}
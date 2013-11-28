<?php

class YearController extends BaseController {

    /**
     * Register Device. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function getYears()
    {
    		$apiKey = Input::get('api_key');
    		$user = User::where('api_key', '=', $apiKey)->firstOrFail();
    		$roles = $user->roles;
    		$adminRoleId = Role::where('role_name', '=', 'admin')->first()->id;
    		if ($roles->contains($adminRoleId)) {
    				$years = Year::all();
    				$yearNumbers = array();
    				foreach($years as $year) {
    						$yearNumbers[] = $year->year_number;
    				}
    				return Response::json($yearNumbers);
    		}
    		$staffMember = Staff::where('user_id', '=', $user->id)->firstOrFail();
    		$nexusClasses = $staffMember->nexusClasses;
    		$yearsThatStaffMemberTeaches = array();
    		foreach ($nexusClasses as $nexusClass) {
    				if(!in_array(Year::find($nexusClass->year_id)->year_number, $yearsThatStaffMemberTeaches)) {
    						$yearsThatStaffMemberTeaches[] = Year::find($nexusClass->year_id)->year_number;
    				}
    		}
    		return Response::json($yearsThatStaffMemberTeaches);
    }

}
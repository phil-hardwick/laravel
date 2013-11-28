<?php

class NexusClassController extends BaseController {

    /**
     * Register Device. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function getNexusClasses()
    {
    		$apiKey = Input::get('api_key');
    		$user = User::where('api_key', '=', $apiKey)->firstOrFail();
    		$roles = $user->roles;
    		$adminRoleId = Role::where('role_name', '=', 'admin')->first()->id;
    		if ($roles->contains($adminRoleId)) {
    				$allNexusClasses = NexusClass::all();
    				$nexusClassesInSelectedYear = array();
    				foreach($allNexusClasses as $nexusClass) {
    						if (Year::find($nexusClass->year_id)->year_number == Input::get('year_number')) {
    								$nexusClassesInSelectedYear[] = array('nexus_class_id' => $nexusClass->id, 'nexus_class_name' => NexusClassType::find($nexusClass->nexus_class_type_id)->name, 'nexus_class_description' => $nexusClass->description);
    						}
    				}
    				return Response::json($nexusClassesInSelectedYear);
    		}
    		$staffMember = Staff::where('user_id', '=', User::where('api_key', '=', $apiKey)->firstOrFail()->id)->firstOrFail();
    		$classesOfStaffMemberOfSelectedYear = array();
    		foreach ($staffMember->nexusClasses as $nexusClass) {
    				if($nexusClass->year_id == Input::get('year_number')) {
    						$classesOfStaffMemberOfSelectedYear[] = array('nexus_class_id' => $nexusClass->id, 'nexus_class_name' => NexusClassType::find($nexusClass->nexus_class_type_id)->name);
    				}
    		}
    		return Response::json($classesOfStaffMemberOfSelectedYear);
    }

}
<?php

class StudentController extends BaseController {

    /**
     * Register Device. Needs parameters:
     * apple_id
     * device_token
     * ios_app_name
     */
    public function getStudents()
    {
    		$nexusClass = NexusClass::find(Input::get('nexus_class_id'));
    		$studentsOfClass = array();
    		foreach ($nexusClass->students as $student) {
    				$studentsOfClass[] = array('student_id' => $student->id, 'student_name' => $student->forename . ' ' . $student->surname);
    		}
    		return Response::json($studentsOfClass);
    }

}
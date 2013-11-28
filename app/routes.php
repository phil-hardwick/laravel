<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('register-device', 'DeviceRegisterController');

Route::group(array('before' => 'authUser|authStaff'), function()
{
		Route::controller('year', 'YearController');

		Route::controller('nexus-class', 'NexusClassController');

		Route::controller('student', 'StudentController');

		Route::controller('register', 'RegisterController');
});



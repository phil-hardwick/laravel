<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('authUser', function()
{
		$user = User::where('api_key', '=', Input::get('api_key'))->first();
		if($user == null) 
		{
				Log::warning('Access attempt from unknown user, api key used: ' . Input::get('api_key'));
        return Response::make('', 404);
		}
		if ($user->is_authenticated == false)
    {
    		Log::warning('Access attempt from deauthenticated device, user: ' . $user->toJson());
        return Response::make('', 404);
    }
});


Route::filter('authStaff', function()
{
		$user = User::where('api_key', '=', Input::get('api_key'))->firstOrFail();
		$userRoles = $user->roles;
		$studentRole = Role::where('role_name', '=', 'Student')->first();
		if ($userRoles->contains($studentRole->id))
    {
    		Log::warning('Access to staff regulated area attempt from user who does not have permission: ' . $user->toJson());
        return Response::make('', 404);
    }
});

Route::filter('authAdmin', function()
{
		$userRoles = User::where('api_key', '=', Input::get('api_key'))->firstOrFail()->roles;
		$adminRole = Role::where('role_name', '=', 'Admin')->first();
		//filter authUser
		if (!$userRoles->contains($adminRole->id))
    {
    		Log::warning('Access to admin regulated area attempt from user who does not have permission: ' . $user->toJson());
        return Response::make('', 404);
    }
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
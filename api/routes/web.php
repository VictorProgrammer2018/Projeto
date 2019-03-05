<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function() use ($router){
	//register
	$router->post('/client/add', 'ClientController@create');
	//login
	$router->post('/login', 'AuthController@authenticate');

	//routes authenticate
	$router->group(['middleware'	=> 'auth'], function() use ($router){
		//update client by id
		$router->put('/client/{id}', 'ClientController@update');
	});
});
<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('register');
});
Route::get('/signup',[
	'as'=>'signup',
	function () {
		return view('register');
	}
	]);


Route::get('/api/users/{email}',[
		'as'=>'user.check',
		'uses'=>'UserController@emailExists'
		]);

Route::post('/api/users/save',[
		'as'=>'user.save',
		'uses'=>'UserController@userSave'
		]);

Route::auth();

Route::group(['middleware' => ['auth']], function() {

	Route::get('/home',[
		'as'=>'home',
		'uses'=>'HomeController@index'
		]);

	Route::post('/account',[
		'as'=>'account',
		'uses'=>'UserController@account'
		]);

	Route::resource('users','UserController');

});






















/*
Route::auth();
Route::get('roles',[
		'as'=>'roles.index',
		'uses'=>'RoleController@index',
		'middleware' => ['role:admin','permission:role-list|role-create|role-edit|role-delete']]);
	Route::get('roles/create',[
		'as'=>'roles.create',
		'uses'=>'RoleController@create',
		'middleware' => ['permission:role-create']
		]);
	Route::post('roles/create',[
		'as'=>'roles.store',
		'uses'=>'RoleController@store',
		'middleware' => ['permission:role-create']
		]);
	Route::get('roles/{id}',[
		'as'=>'roles.show',
		'uses'=>'RoleController@show'
		]);
	Route::get('roles/{id}/edit',[
		'as'=>'roles.edit',
		'uses'=>'RoleController@edit',
		'middleware' => ['permission:role-edit']
		]);
	Route::patch('roles/{id}',[
		'as'=>'roles.update',
		'uses'=>'RoleController@update',
		'middleware' => ['permission:role-edit']
		]);
	Route::delete('roles/{id}',[
		'as'=>'roles.destroy',
		'uses'=>'RoleController@destroy',
		'middleware' => ['permission:role-delete']
		]);

	Route::get('itemCRUD2',[
		'as'=>'itemCRUD2.index',
		'uses'=>'ItemCRUD2Controller@index',
		'middleware' => ['permission:item-list|item-create|item-edit|item-delete']
		]);
	Route::get('itemCRUD2/create',[
		'as'=>'itemCRUD2.create',
		'uses'=>'ItemCRUD2Controller@create',
		'middleware' => ['permission:item-create']
		]);
	Route::post('itemCRUD2/create',[
		'as'=>'itemCRUD2.store',
		'uses'=>'ItemCRUD2Controller@store',
		'middleware' => ['permission:item-create']
		]);
	Route::get('itemCRUD2/{id}',[
		'as'=>'itemCRUD2.show',
		'uses'=>'ItemCRUD2Controller@show'
		]);
	Route::get('itemCRUD2/{id}/edit',[
		'as'=>'itemCRUD2.edit',
		'uses'=>'ItemCRUD2Controller@edit',
		'middleware' => ['permission:item-edit']
		]);
	Route::patch('itemCRUD2/{id}',[
		'as'=>'itemCRUD2.update',
		'uses'=>'ItemCRUD2Controller@update',
		'middleware' => ['permission:item-edit']
		]);
	Route::delete('itemCRUD2/{id}',[
		'as'=>'itemCRUD2.destroy',
		'uses'=>'ItemCRUD2Controller@destroy',
		'middleware' => ['permission:item-delete']
		]);*/
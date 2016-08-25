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


Route::get('resizeImage', 'UploadController@resizeImage');
Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'UploadController@resizeImagePost']);




Route::post('upload', 'UploadController@upload');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('register');
});
Route::get('/signup', [
    'as' => 'signup',
    function () {
        return view('register');
    }
]);

Route::post('/fileUpload', [
    'as' => 'fileUpload',
    'uses' => 'UploadController@fileUpload'
]);


Route::post('/fileUpload2', [
    'as' => 'fileUpload2',
    'uses' => 'UploadController@fileUpload2'
]);

Route::get('/registered', function () {
    return view('users.user-registered');
});

Route::get('/api/users/{email}', [
    'as' => 'user.check',
    'uses' => 'UserController@emailExists'
]);
Route::get('/api/user_involvements/{user_id}', [
    'as' => 'user_involvements',
    'uses' => 'UserController@userInvolvements'
]);
Route::get('/api/user_family/{user_id}', [
    'as' => 'user_family',
    'uses' => 'UserController@userIAlumniFamilyMembers'
]);

Route::get('/api/users_for_approval', [
    'as' => 'user.for_approval',
    'uses' => 'UserController@userForApproval'
]);
Route::get('/api/users', [
    'as' => 'users',
    'uses' => 'UserController@getUsers'
]);
Route::post('/api/users/save', [
    'as' => 'user.save',
    'uses' => 'UserController@userSave'
]);

Route::get('/api/user/roles/{user_id}', [
    'as' => 'user.roles',
    'uses' => 'UserController@userRoles'
]);






Route::auth();

Route::group(['middleware' => ['auth']], function () {


    Route::post('/api/user_involvement/save', [
        'as' => 'user_involvement.save',
        'uses' => 'UserController@userInvolvementSave'
    ]);
    Route::post('/api/user_involvement/update', [
        'as' => 'user_involvement.update',
        'uses' => 'UserController@userInvolvementUpdate'
    ]);
    Route::post('/api/user_involvement/delete', [
        'as' => 'user_involvement.delete',
        'uses' => 'UserController@userInvolvementDelete'
    ]);
    Route::post('/api/users/update', [
        'as' => 'user.update',
        'uses' => 'UserController@userUpdate'
    ]);
    Route::post('/api/user_family/save', [
        'as' => 'user_family.save',
        'uses' => 'UserController@userFamilySave'
    ]);

    Route::post('/api/user_family/update', [
        'as' => 'user_family.update',
        'uses' => 'UserController@userFamilyUpdate'
    ]);
    Route::post('/api/user_family/delete', [
        'as' => 'user_family.delete',
        'uses' => 'UserController@userFamilyDelete'
    ]);
    Route::post('/api/user/approve', [
        'as' => 'user.approve',
        'uses' => 'UserController@userApprove'
    ]);
    Route::get('/home', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);

    Route::get('/account/{id}', [
        'as' => 'user.account',
        'uses' => 'UserController@userAccount'
    ]);


    Route::get('/approval', [
        'as' => 'users.approval',
        'uses' => 'UserController@approval'

    ]);
    Route::get('/users', [
        'as' => 'users.index',
        'uses' => 'UserController@index'

    ]);



    Route::resource('users', 'UserController');

});






















/*
Route::auth();
Route::get('roles',[
		'as'=>'roles.index',
		'uses'=>'RoleController@index',
		'middleware' => ['role:admin','permission:role-list|role-create|role-edit|role-delete']
]);
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
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(array('middleware'=>['auth']), function() {

    /**
	 * Roles and Permissions
	 */
    Route::resource('roles', 'Configuration\RolePermission\RoleController');
	// Route::get('/roles_get_data', 'Configuration\RolePermission\RoleController@get_data')->name('roles.get_data');
	// restore
	Route::post('roles/restore/{department}', [
		'as' => 'roles.restore',
		'uses' => 'Configuration\RolePermission\RoleController@restore'
    ]);
    
    Route::resource('permissions', 'Configuration\RolePermission\PermissionController');
	// Route::get('/permissions_get_data', 'Configuration\RolePermission\PermissionController@get_data')->name('permissions.get_data');
	// restore
	Route::post('permissions/restore/{department}', [
		'as' => 'permissions.restore',
		'uses' => 'Configuration\RolePermission\PermissionController@restore'
	]);
	
	/**
	 * Positions
	 */
	Route::resource('positions', 'Configuration\PositionController');
	// restore
	Route::post('positions_restore/{position}', [
		'as' => 'positions.restore',
		'uses' => 'Configuration\PositionController@restore'
	]);

	/**
	 * Elections
	 */
	Route::resource('elections', 'ElectionController');
	// restore
	Route::post('elections_restore/{position}', [
		'as' => 'elections.restore',
		'uses' => 'ElectionController@restore'
	]);

	/**
	 * Results
	 */
	Route::resource('results', 'ResultController');
	// restore
	Route::post('results_restore/{result}', [
		'as' => 'results.restore',
		'uses' => 'ResultController@restore'
	]);

	/**
	 * Tasks
	 */
	Route::resource('tasks', 'TaskController');
	// restore
	Route::post('tasks_restore/{task}', [
		'as' => 'tasks.restore',
		'uses' => 'TaskController@restore'
	]);

    
    /**
	 * Users
	 */
	Route::resource('users', 'UserController');
	// sidebar collapase
	/* Route::get('user_sidebar_collapse', [
		'as' => 'users.sidebar_collapse',
		'uses' => 'UserController@sidebar_collapse'
	]); */
	// restore
	Route::post('users_restore/{user}', [
		'as' => 'users.restore',
		'uses' => 'UserController@restore'
	]);

});

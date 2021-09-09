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

Route::group(array('middleware' => 'langMiddleware'), function () {
  /*
   * Lang
   */
  Route::get('lang/{lang}', function ($lang) {
      session(['lang' => $lang]);
      return \Redirect::back();
  })->where([
      'lang' => 'en|es'
  ]);

	/*Redirect al admin*/
	Route::get('/', array('as' => 'home', 'uses' => 'FrontEndController@redirect'));

	Route::group(array('prefix' => 'admin'), function () {
	  Route::post('data', array('as' => 'data', 'uses' => 'DataTablesController@data'));
	});

	Route::group(array('prefix' => 'admin'), function () {
		/*Dashboard inicial*/
		Route::get('/', array('as' => 'dashboard', 'uses' => 'DashboardController@index'));

		// Schedules
		$route = 'schedules';
		$controller = 'ScheduleController';
		Route::group(array('prefix' => $route), function () use ($route, $controller) {
		    Route::get('deleted', array('as' => $route.'.deleted', 'uses' => $controller.'@getRestore'));
		    Route::patch('restore', array('as' => $route.'.restore', 'uses' => $controller.'@postRestore'));
		    Route::get('/', array('as' => $route, 'uses' => $controller.'@index'));
		    Route::delete('delete', array('as' => $route.'.delete', 'uses' => $controller.'@destroy'));
		    Route::get('create', array('as' => $route.'.create', 'uses' => $controller.'@create'));
		    Route::post('create', array('as' => $route.'.store', 'uses' => $controller.'@store'));
		    Route::get('{id}/edit', array('as' => $route.'.edit', 'uses' => $controller.'@edit'));
		    Route::put('{id}/edit', array('as' => $route.'.update', 'uses' => $controller.'@update'));
		    Route::get('{id}', array('as' => $route.'.show', 'uses' => $controller.'@show'));
		});
	});
});

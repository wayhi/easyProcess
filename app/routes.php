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


Route::post('/','app\controllers\login\LoginController@postLogin');
Route::get('/', array('as' => 'login', 'uses' => 'app\controllers\login\LoginController@getLogin'));
Route::get('Nav/nav', array('as' => 'Nav.nav', 'uses' => 'app\controllers\nav\NavController@showNav'));

Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::any('/', 'App\Controllers\Admin\PagesController@index');
    Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
    Route::resource('pages', 'App\Controllers\Admin\PagesController');
    
});

Route::group(array('prefix' => 'Nav', 'before'=> 'auth.admin'),function()
{
	Route::any('/','app\controllers\login\NavController@showNav');
	
	Route::resource('nav', 'app\controllers\nav\NavController@showNav');

});
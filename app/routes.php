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

Route::get('login', array('as' => 'login', 'uses' => 'app\controllers\login\LoginController@getLogin'));
Route::post('login','app\controllers\login\LoginController@postLogin');
Route::get('/', function(){return Redirect::route('login');});
Route::get('Nav/nav', array('as' => 'Nav.nav', 'uses' => 'app\controllers\nav\NavController@showNav'));
Route::get('payment/create', array('as' => 'payment.create', 'uses' => 'app\controllers\payment\PaymentController@create'));
Route::get('payment/store', array('as' => 'payment.store', 'uses' => 'app\controllers\payment\PaymentController@store'));

Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::any('/', 'App\Controllers\Admin\PagesController@index');
    Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
    Route::resource('pages', 'App\Controllers\Admin\PagesController');
    
});

Route::group(array('prefix' => 'nav', 'before' => 'auth.login'), function()
{
	Route::any('/', 'app\controllers\nav\NavController@index');
	
	Route::resource('nav', 'app\controllers\nav\NavController@showNav');

});
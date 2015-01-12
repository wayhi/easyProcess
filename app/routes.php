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
Route::get('logout', array('as'=>'logout','uses'=>'app\controllers\login\LoginController@getLogout'));
Route::group(array('before'=>'auth.login'),function(){

	Route::get('/', function(){return Redirect::route('login');});
	Route::get('register',['as'=>'register','uses'=>'App\controllers\user\UserController@register']);
	Route::post('register',['as'=>'register','uses'=>'App\controllers\user\UserController@PostRegister']);
	Route::get('Nav/nav', array('as' => 'Nav.nav', 'uses' => 'app\controllers\nav\NavController@showNav'));
	Route::get('payment/start',array('as'=>'payment.start','uses'=>'App\Controllers\payment\PaymentController@start'));
	
	Route::get('vendorsearch',function(){
			return Vendor::where('vendor_name','like','%'.Input::get('term').'%')->where('visible','=',1)
			->orWhere(function($query){$query->where('vendor_code','=',Input::get('term'))->where('visible','=',1);})
			->take(10)->lists('vendor_name');
				});
	Route::get('banksearch',function(){
		return DB::table('v_bankinfo')->where('vendor_name',Input::get('term'))->lists('bank_info');
	
	});	
	Route::post('payment/create',array('as'=>'payment.create','uses' => 'App\Controllers\payment\PaymentController@create'));		
	Route::Resource('payment', 'App\Controllers\payment\PaymentController');
	Route::Resource('vendor','App\Controllers\vendor\VendorController');

});

Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function()
{
    Route::any('/', 'App\Controllers\Admin\PagesController@index');
    Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
    Route::resource('pages', 'App\Controllers\Admin\PagesController');
    
}


);


Route::group(array('prefix' => 'Nav', 'before' => 'auth.login'), function()
{
	Route::any('/', 'app\controllers\nav\NavController@index');
	
	Route::resource('nav', 'app\controllers\nav\NavController@showNav');

});
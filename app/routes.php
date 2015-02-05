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
Route::match(['get','post'],'reset_password',['as'=>'reset_password','uses'=>'app\controllers\login\LoginController@show_reset_password']);
Route::post('email_confirm',['as'=>'email_confirm','uses'=>'app\controllers\login\LoginController@email_confirm']);
Route::match(['get','post'],'change_password/{resetcode?}/{uid?}',['as'=>'change_password','uses'=>'app\controllers\login\LoginController@change_password']);
Route::post('password_confirm',['as'=>'password_confirm','uses'=>'app\controllers\login\LoginController@password_confirm']);

Route::group(array('before'=>'auth.login'),function(){

	Route::get('/', function(){return Redirect::route('login');});
	Route::get('register',['as'=>'register','uses'=>'App\controllers\user\UserController@register']);
	Route::post('register',['as'=>'register','uses'=>'App\controllers\user\UserController@PostRegister']);
	Route::get('Nav/nav', array('as' => 'Nav.nav', 'uses' => 'app\controllers\nav\NavController@showNav'));
	Route::get('payment/start',array('as'=>'payment.start','uses'=>'App\Controllers\payment\PaymentController@start'));
	Route::post('userprofile',['as'=>'userprofile','uses'=>'App\controllers\user\UserController@editProfile']);
	Route::get('vendorsearch',function(){
			return Vendor::where('vendor_name','like','%'.Input::get('term').'%')->where('visible','=',1)
			->orWhere(function($query){$query->where('vendor_code','=',Input::get('term'))->where('visible','=',1);})
			->take(10)->lists('vendor_name');
				});
	Route::get('banksearch',function(){
		return DB::table('v_bankinfo')->where('vendor_name',Input::get('term'))->lists('bank_info');
	
	});	
	Route::get('getApprovalSettings',function(){
		
		switch(Input::get('term')){
			
			case "1":
				return V_cctr::all()->toJson();
			break;
			case "2":
				return V_account::all()->toJson();
			break;
			case "3":
			break;
		
		}
		
		
	});
	Route::get('payment/downpayments/{vendor_name}',['as'=>'payment.downpayments','uses' => 'App\Controllers\payment\PaymentController@downpayments']);
	Route::post('payment/create',array('as'=>'payment.create','uses' => 'App\Controllers\payment\PaymentController@create'));		
	Route::Resource('payment', 'App\Controllers\payment\PaymentController');
	Route::Resource('vendor','App\Controllers\vendor\VendorController');
	Route::Resource('approval','App\Controllers\approval\ApproveController');
});

Route::get('admin/logout', array('as' => 'admin.logout', 'uses' => 'App\Controllers\Admin\AuthController@getLogout'));
Route::get('admin/login', array('as' => 'admin.login', 'uses' => 'App\Controllers\Admin\AuthController@getLogin'));
Route::post('admin/login', array('as' => 'admin.login.post', 'uses' => 'App\Controllers\Admin\AuthController@postLogin'));

Route::group(array('prefix' => 'admin', 'before' => 'auth.login'), function()
{
    Route::any('/', 'App\Controllers\Admin\PagesController@index');
    Route::resource('articles', 'App\Controllers\Admin\ArticlesController');
    Route::resource('pages', 'App\Controllers\Admin\PagesController');
    Route::resource('approval','App\Controllers\Admin\ApprovalController');
}


);


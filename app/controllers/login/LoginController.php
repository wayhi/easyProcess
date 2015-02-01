<?php

namespace app\controllers\login;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Payment,Debugbar;

class LoginController extends \BaseController {

	/**
   * 显示登录页面
   * @return View
   */
  public function getLogin()
  {
    return View::make('Login.login');
  }
  
  public function postLogin()
  {
    $credentials = array(
      'email'    => Input::get('email'),
      'password' => Input::get('password')
    );

    try
    {
      $user = Sentry::authenticate($credentials, false);
	//Debugbar::info($user);
      if ($user)
      {
        $waiting_for_approval = count(Payment::where('reviewer_id',$user->id)->lists('id'));
        if($waiting_for_approval>0){
        	return View::make('Nav.nav')->with('count',$waiting_for_approval);
        }else{
        	return View::make('Nav.nav');
        }
      }
    }
    catch(\Exception $e)
    {
      return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
    }
  }
  
   /**
   * 注销
   * @return Redirect
   */
  public function getLogout()
  {
    Sentry::logout();

    return redirect::route('login');
  }
}
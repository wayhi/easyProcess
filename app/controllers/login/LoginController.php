<?php

namespace app\controllers\login;

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

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

      if ($user)
      {
        return Redirect::route('admin.pages.index');
      }
    }
    catch(\Exception $e)
    {
      return Redirect::route('login')->withErrors(array('login' => $e->getMessage()));
    }
  }
}
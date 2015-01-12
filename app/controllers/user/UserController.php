<?php

namespace App\controllers\user;

use BaseController, Input, Redirect, Sentry, View, Notification;

class UserController extends BaseController {

  /**
   * 显示用户注册页面
   * @return View
   */
  public function register()
  {
    return View::make('user.register');
  }

  public function postRegister(){
  
  	try{
    // Create the user
    $user = Sentry::createUser(array(
        'email'     => Input::get('email'),
        'password'  => Input::get('password'),
        'activated' => true,
    ));

    // Find the group using the group id
    $adminGroup = Sentry::findGroupById(2);

    // Assign the group to the user
    $user->addGroup($adminGroup);
    
}
catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
{
    Notification::error('Login field is required.');
}
catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
{
    Notification::error('Password field is required.');
}
catch (Cartalyst\Sentry\Users\UserExistsException $e)
{
    Notification::error('User with this login already exists.');
}
catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
{
    Notification::error('Group was not found.');
}
  
  return Redirect::route('register');
  
  }
  
  }
<?php

namespace App\controllers\user;

use BaseController, Input, Redirect, Sentry, View, Notification, Crypt, User_profile,User,V_cctr;

class UserController extends BaseController {

  /**
   * 显示用户注册页面
   * @return View
   */
  public function register()
  {
    $user_options=User::activated()->orderBy('last_name')->lists('last_name','id');
  	$cctr_options=V_cctr::getList();
    
    return View::make('user.register')->with('user_options',$user_options)->with('cctr_options',$cctr_options);
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
  
  Notification::success('User '.Input::get('email').(' has been created successfully!') );
  return Redirect::route('register');
  
  }
  
  public function editProfile(){
  
  	if(Input::has('user_id')){
  		$id = Input::get('user_id');
  	
  	}
  	
  	if(Input::has('refresh')){
  		$user = User::find($id);
  	
  		if($user){
  		
  			$profile = $user->profile;
  			if($profile){
  				$cctr_id=$profile->cctr_id;
  				$approver_id = $profile->approver_id;
  				
  			}
  		return Redirect::route('register')->with('cctr_id',$cctr_id)->with('approver_id',$approver_id)->withInput();
  		}
  	}	
  	
  	if(Input::has('update')){
  		$user = User::find($id);
  	
  		if($user){
  		
  			//$profile = User_profile::where('user_id','=',$id)->first();
  			
  			$profile = $user->profile;
			
  			if(!$profile){
  				$profile = new User_profile;
  				$profile->user_id = $id;
  			}
  		
  		}else{
  		
  			return Redirect::route('Nav.nav');
  		
  		}
  	
  		$profile->cctr_id = intval(Input::get('cctr_id'));
  		$profile->entity_id = intval(Input::get('entity_id'));
  		$profile->approver_id = intval(Input::get('approver_id'));
  		$profile->save();
  		
  		return Redirect::route('register')->withInput();
  	}
  }
  
  }
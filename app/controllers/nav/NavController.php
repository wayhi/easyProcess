<?php

namespace app\controllers\nav;

use Auth, BaseController, Form, Input, Redirect, Sentry, View, Payment;

class NavController extends \BaseController {

	/**
   * 显示导航界面
   * @return View
   */
   
    public function index()
  {
  	
  	return View::make('Nav.nav');
  
  }
  
  public function showNav()
  {
    $user = Sentry::getuser();
    if ($user){
        $waiting_for_approval = count(Payment::where('reviewer_id',$user->id)->lists('id'));
        if($waiting_for_approval>0){
        	return View::make('Nav.nav')->with('count',$waiting_for_approval);
        }else{
        	return View::make('Nav.nav');
        }
      }else{
      return redirect::route('login');
      }
    
    //return View::make('Nav.nav');
    
    
  }
  
 
  
 
}
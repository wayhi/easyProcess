<?php

namespace app\controllers\nav;

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

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
    return View::make('Nav.nav');
    
    
  }
  
 
  
 
}
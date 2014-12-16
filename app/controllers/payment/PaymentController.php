<?php

namespace app\controllers\payment;

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class PaymentController extends \BaseController {

	/**
   * 显示导航界面
   * @return View
   */
   
    public function create()
  {
  	
  	return View::make('payment.create');
  
  }
  
  public function edit()
  {
    //return View::make('Nav.nav');
    
    
  }
  
  public function store()
  
  {
  
  
  
  }
 
  
 
}
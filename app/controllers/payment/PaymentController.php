<?php


namespace app\controllers\payment;

use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class PaymentController extends \BaseController {


   
    public function create()
  {
  	
  	return View::make('payment.create');
  
  }
  
  public function edit($id)
  {
    //return View::make('Nav.nav');
    
    
  }
  
  public function store()
  
  {
  
  
  
  }
 
	public function index(){
	
	
	}
	
	public function show($id) {
	
	
	}  
	
	public function update($id) {
	
	}
	
	public function destroy($id) {
	
	
	}
 
}
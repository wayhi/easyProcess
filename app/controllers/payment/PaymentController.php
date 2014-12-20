<?php


namespace App\Controllers\payment;


use V_cctr,V_account;
use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class PaymentController extends \BaseController {

	public function create(){
    
  	$view = View::make('payment.create');
  	$cctrs = V_cctr::all(); //成本中心列表
  	$accts = V_account::all();// 费用科目
  	
  	if(count($accts)>0 ) {
  		//$code = $accts->lists('acct_code');
  		//$desc = $accts->lists('acct_desc');
  		
  		$acct_options = array_combine($accts->lists('id'),  $accts->lists('acct_options'));
  		
  	} else {
  	
  		$acct_options = array(null, 'Not Available');
  	};
  	
  	if(count($cctrs)>0 ) {
  	
  		$cctr_options = array_combine($cctrs->lists('id'), $cctrs->lists('cctr_options'));
  	} else {
  	
  		$cctr_options = array(null, 'Not Available');
  	};
  	
  	//View::composer('payment.create',);
  		$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('row_count',2);
  	return $view;
  
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
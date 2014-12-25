<?php


namespace App\Controllers\payment;


use V_cctr,V_account;
use Auth, BaseController, Form, Input, Redirect, Sentry, View;

class PaymentController extends \BaseController {

	public function create(){
    
  	$view = View::make('payment.create');
  	$cctrs = V_cctr::all(); //成本中心列表
  	$accts = V_account::all();// 费用科目
  	
  	if(Input::has('row_count')){
  		$row_count = intval(Input::get('row_count'));
  		$cctr_1 = intval(Input::get('cctr_1'));
  	}else{
  		$row_count =1;
  	
  	}
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
  	
  	//View::composer('payment.edit',);
  		$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('row_count',$row_count)->with('cctr_1',$cctr_1);
  	return $view;
  
  }
  
  	public function edit(){
    
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
  		$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('row_count',5);
  	return $view;
  
    
  }
  
  	public function store(){
  	
  	
  	if(Input::has('row_count') ){
  		$row_count=intval(Input::get('row_count'))+1;
  	}else{
  		$row_count=1;
  	}
  	return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput(array('cctr_1'=>'2'));
  	//return Redirect::back()->withInput()->with('row_count',2);
  
  }
 
	public function index(){
	
	
	}
	
	public function show($id) {
	
	
	}  
	
	public function update($id) {
	
	}
	
	public function destroy($id) {
	
	
	}
	
	public function missingMethod($parameters = array())
{
    //
}
 
}
<?php

namespace App\Controllers\vendor;


use Vendor,Bank,Notification;
use BaseController, Form, Input, Redirect, Sentry, View, Validator, DB;

class VendorController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /vendor/venodr
	 *
	 * @return Response
	 */
	 
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /vendor/venodr/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
		
		$view = View::make('vendor.create');
  	
  		if(Input::has('bank_num')){
  			$row_count = intval(Input::get('bank_num'));
  		}else{
  			$row_count =1;
  	
  		}
		
		return $view->with('bank_num',$row_count);
		
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /vendor/venodr
	 *
	 * @return Response
	 */
	public function store()
	{
		$bank_num=1;
  		
  		if(Input::has('addrow') || Input::has('delrow')){//增加或减少分摊明细行数
  			if(Input::has('bank_num') && Input::has('addrow') ){
  				$bank_num=intval(Input::get('banl_num'))+1;
  			}elseif(Input::has('bank_num') && Input::has('delrow')) {
  				$bank_num=intval(Input::get('bank_num'));
  				if($bank_num>1){
  					$bank_num=$bank_num-1;
  				}
  			}else{	
  				$bank_num=1;
  			}
  		return Redirect::route('vendor.create',array('bank_num'=>$bank_num))->withInput();
  		};
		
		if(Input::has('submit')){//提交表单
  		
  			
  			if(Input::has('bank_num')){
  				$bank_num=intval(Input::get('bank_num'));
  			}
  			
  			
  			
  			//定义规则
  			
  			 $rules = array(
  			 'vendor_name'=>'required|max:99',
  			 'vendor_code'=>'alpha_dash|max:99',
  			 
  			 
  			 
  			 );
			//验证Vendor字段
    		$validator = Validator::make(Input::all(), $rules);
    		if($validator->fails()) {
  				
  				return Redirect::route('vendor.create',array('bank_num'=>$bank_num))->withInput()
  				->withErrors($validator);
			}
    		
    		//验证bank
    		
    		for($i=1;$i<=$bank_num;$i++){
    			$validator = Validator::make(
    				array(
    				'bank_name_'.$i=>Input::get('bank_name_'.$i),
    				'branch_name_'.$i=>Input::get('branch_name_'.$i),
    				'bank_account_'.$i=>Input::get('bank_account_'.$i),
    				'bank_code_'.$i=>Input::get('bank_code_'.$i),
    				'swift_code_'.$i=>Input::get('swift_code_'.$i),
    				),
    				array(
    				'bank_name_'.$i=>'required|max:99',
    				'branch_name_'.$i=>'required|max:99',
    				'bank_account_'.$i=>'required|alpha_dash|max:99',
    				'bank_code_'.$i=>'alpha_dash|max:99',
    				'swift_code_'.$i=>'alpha_dash|max:99'
    				)
    			);
    			if($validator->fails()) {
  				
  				return Redirect::route('vendor.create',array('bank_num'=>$bank_num))->withInput()
  				->withErrors($validator);
				}

    		}
    		
  				
  			//	提交数据
  			
  			
  			
  			DB::transaction(function(){
  				
  				if(Input::has('bank_num')){
  					$bank_num=intval(Input::get('bank_num'));
  				}
  					
  				
  				
  				
  				$vendor = Vendor::create(array(
  					'vendor_name' => Input::get('vendor_name'),
  					'vendor_code' => Input::get('vendor_code'),
  					'vendor_name_short' => Input::get('vendor_name_short'),
  					'address'=>Input::get('address'),
  					'contact_name'=>Input::get('contact_name'),
  					'contact_tel'=>Input::get('contact_tel'),
  					'visible'=>1,
  					'type'=>1,
  					'group_id'=>1,
  					'created_by_user' => Sentry::getUser()->id, 
  					));
  					
  				if(!$vendor){
  					//throw new \Exception('数据提交没有成功！');
  					Notification::error('数据提交没有成功！');
  				}
  					
  				
  				
  				for($i=1;$i<=$bank_num;$i++){
  					
  					$bank = Bank::create([
  						'vendor_id' => $vendor->id,
  						'bank_name' => Input::get('bank_name_'.$i),
  						'branch_name' => Input::get('branch_name_'.$i),
  						'bank_account' => Input::get('bank_account_'.$i),
  						'bank_code' => Input::get('bank_code_'.$i),
  						'swift_code' => Input::get('swift_code_'.$i),
  						'updated_by' => Sentry::getUser()->id,
  						'activated' => 1,
  						]);
  						
  					if(!$bank){
  						Notification::error('数据提交没有成功！');
        				//throw new \Exception('数据提交没有成功！');
        			}	
    			}	
  				
  			
  			});
  			
  			return Redirect::route('Nav.nav');
  								
  	}
		
		
		
		
		
		
	}

	/**
	 * Display the specified resource.
	 * GET /vendor/venodr/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /vendor/venodr/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /vendor/venodr/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /vendor/venodr/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
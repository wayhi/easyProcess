<?php


namespace App\Controllers\payment;


use V_cctr,V_account,Payment,Allocation,Notification,Attachement,Control;
use Auth, BaseController, Form, Input, Redirect, Sentry, View, Validator, DB;

class PaymentController extends \BaseController {
	
	
	
	public function create(){
    
  	$view = View::make('payment.create');
  	
  	
  	if(Input::has('row_count')){
  		$row_count = intval(Input::get('row_count'));
  		//$cctr_1 = intval(Input::get('cctr_1'));
  	}else{
  		$row_count =1;
  	
  	}
  	
  	$acct_options = V_account::getList();//费用科目列表
  	$cctr_options=V_cctr::getList();//成本中心列表
  	$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('row_count',$row_count);
  	
  	return $view;
  
  }
  
  	public function edit(){
    
    $view = View::make('payment.create');
  	
  	
  	$acct_options=V_account::getList();//费用科目列表
  	$cctr_options=V_cctr::getList();//成本中心列表
  	
  	//View::composer('payment.create',);
  		$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('row_count',5);
  	return $view;
  
    
  }
  
  	public function store(){
  		
  		$row_count=1;
  		
  		if(Input::has('addrow') || Input::has('delrow')){//增加或减少分摊明细行数
  			if(Input::has('row_count') && Input::has('addrow') ){
  				$row_count=intval(Input::get('row_count'))+1;
  			}elseif(Input::has('row_count') && Input::has('delrow')) {
  				$row_count=intval(Input::get('row_count'));
  				if($row_count>1){
  					$row_count=$row_count-1;
  				}
  			}else{	
  				$row_count=1;
  			}
  		return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput();
  		};
  		
  		if(Input::has('submit')){//提交表单
  		
  			
  			if(Input::has('row_count')){
  				$row_count=intval(Input::get('row_count'));
  			}
  			
  			
  			
  			//定义规则
  			
  			 $rules = array(
  			 'Payee'=>'required',
  			 'bank_info'=>'required|alpha_dash|between:1,999',
  			 'total_amount'=>'required|numeric|between:0,99999999',
  			 'vat'=>'numeric',
  			 'attachement'=>'max:2048',
  			 
  			 );
			//验证主表字段
    		$validator = Validator::make(Input::all(), $rules);
    		if($validator->fails()) {
  				//Former::withErrors($validator);
  				return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
			}
    		
    		//验证分摊表字段
    		
    		for($i=1,$amount_allocated=0.00;$i<=$row_count;$i++){
    			$validator = Validator::make(
    				array('amount_'.$i=>Input::get('amount_'.$i)),
    				array('amount_'.$i=>'required|numeric')
    			);
    			if($validator->fails()) {
  				
  				return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
				}else{
				
					$amount_allocated = $amount_allocated + floatval(Input::get('amount_'.$i));
					
				}

    		}
    		
  			//验证总金额和分摊表累计金额
  			//if(floatval(Input::get('total_amount'))<>$amount_allocated){
  				//抛出异常
  				
  			//}
  			$validator = Validator::make(
    				array('total_amount'=>Input::get('total_amount')),
    				array('total_amount'=>'in:'.$amount_allocated)
    			);
    		if($validator->fails()) {
  				
  				return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
  			  		
  			}
  				
  			//	提交数据
  			
  			//$is_downpayment=-1;
  			
  			DB::transaction(function(){
  				if(Input::has('is_downpayment')){ //判断是否预付款
  				
  					$pmt_type=-1;
  				}else{
  					$pmt_type=1;
  				}	
  			
  				if(Input::has('row_count')){
  					$row_count=intval(Input::get('row_count'));
  				}
  					
  				
  				
  				
  				$payment = Payment::create(array(
  					'payee_id' => 1,
  					'payer_id' => 1,
  					'amount' => floatval(Input::get('total_amount')),
  					'created_by_user' => Sentry::getUser()->id, 
  					'currency' => 1,
  					'vat_amount' => floatval(Input::get('vat')),
  					'type' => $pmt_type,
  					'invoice_code' => Input::get('invoice_code'),
  					'status' => 1,
  					'order_number' => Input::get('order_number'),
  					'pmt_due_date' => Input::get('due_date'),
  					'urgency' => 0,
  					'description' => Input::get('description'),
  					'attachement' => '',
  					));
  					
  				if(!$payment){
  					throw new \Exception('数据提交没有成功！');
  				}
  				$pid=$payment->id;
  				if(Input::hasFile('attachement')){//附件上传
  					$upload_files=Input::file('attachement');
  					$i=1;
  					foreach($upload_files as $upload){
  					
  						$attachement = new Attachement;
  						$attachement->voucher = $upload;
  						$attachement->parent_id = $pid;
  						$attachement->serial_number=$i;
  						$attachement->save();
  						$i++;
  					}
  					
  				}else{
  				
  					//Notification::error('No attachement has been found!');
  				}	
  				
  				
  				for($i=1;$i<=$row_count;$i++){
  					
  					$allocation = Allocation::create([
  						'pmt_id' => $payment->id,
  						'cctr_id' => intval(Input::get('cctr_'.$i)),
  						'acct_id' => intval(Input::get('acct_'.$i)),
  						'amount_original' => floatval(Input::get('amount_'.$i)),
  						'amount_final' => floatval(Input::get('amount_'.$i)),
  						'updated_by' => Sentry::getUser()->id,
  						]);
  						
  					if(!$allocation){
  					
        				
        				throw new \Exception('数据提交没有成功！');
        			}	
    			}	
  			echo self::findApprovers($pid);	
  			
  			});
  			
  			//return Redirect::route('Nav.nav');
  								
  	}
  }
 
	public function index(){
	
	
	}
	
	public function show($id) {
	
	
	}  
	
	public function update($id) {
	
	}
	
	public function destroy($id) {
	
	
	}
	
	public function start(){
	
		return View::make('payment.start');
	}
	
	private function findApprovers($pmtid){
	
		$pmt = Payment::find($pmtid);
		$applicant_id = $pmt->created_by_user;
		
		$arr_cctrs = $pmt->cctrs;
		$arr_accounts = $pmt->accounts;
	
		foreach($arr_cctrs as $cctr){
		
			//$cctr_amounts = array_add($cctr_amounts,
			//$cctr->id,
			$cctr_amount = Allocation::where('cctr_id','=',$cctr->id)->where('pmt_id','=',$pmtid)->sum('amount_final');
			
			$cctr_query = DB::table('controls')->where('control_id','=',$cctr->id)
			->where('approval_start','<',$cctr_amount)
			->where('approval_limit','>=',$cctr_amount)
			->where('authority_user','<>',$applicant_id)
			->where('control_type_id','=',1)->distinct();
			$cctr_approvers = DB::table('controls')->where('control_id','=',$cctr->id)
			->where('mandatory','=',1)
			->where('authority_user','<>',$applicant_id)
			->where('control_type_id','=',1)->union($cctr_query)
			->orderBy('approval_level');
			$approvers_1 = $cctr_approvers->distinct()->lists('Authority_user');
			
			
			
			
		}
		
		foreach($arr_accounts as $account){
			
			$acct_amount = Allocation::where('account_id','=',$account->id)->where('pmt_id','=',$pmtid)->sum('amount_final');
			
			$acct_query = DB::table('controls')->where('control_id','=',$account->id)
			->where('approval_start','<',$acct_amount)
			->where('approval_limit','>=',$acct_amount)
			->where('authority_user','<>',$applicant_id)
			->where('control_type_id','=',2)->distinct();
			$acct_approvers = DB::table('controls')->where('control_id','=',$account->id)
			->where('mandatory','=',1)
			->where('authority_user','<>',$applicant_id)
			->where('control_type_id','=',2)->union($acct_query)
			->orderBy('approval_level');
			$approvers_2 = $acct_approvers->distinct()->lists('Authority_user');
			
		}
		
		return array_merge($approvers_1, $approvers_2);
	}
	
	
	public function missingMethod($parameters = array()){
    //
	}
 
}
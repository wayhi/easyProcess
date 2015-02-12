<?php


namespace App\Controllers\payment;


use V_cctr,V_account,Payment,Allocation,Notification,Attachement,Control,Count,Debugbar;
use Input, Redirect, Sentry, View, Validator, DB, Crypt, Payment_approval;

class PaymentController extends \BaseController {
	
	
	
	public function create(){
    
  	$view = View::make('payment.create');
  	
  	
  	if(Input::has('row_count')){
  		$row_count = intval(Input::get('row_count'));
  		//$cctr_1 = intval(Input::get('cctr_1'));
  	}else{
  		$row_count =1;
  	
  	}
  	if(Input::has('vendor_name')){
  	
  		$vendor_name = Input::get('vendor_name');
  	}
  	
  	$acct_options = V_account::getList();//费用科目列表
  	$cctr_options=V_cctr::getList();//成本中心列表
  	$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)
  	->with('row_count',$row_count)->with('vendor_name',$vendor_name);
  	
  	return $view;
  
  }
  
  	public function edit($id){
    
    	$uid = Crypt::decrypt($id);
   		$payment = Payment::with('allocations')->find($uid);
   		
   		if(Sentry::getUser()->id <> $payment->created_by_user){
   		
   			Return Redirect::route('login');
   		
   		}else{
			$view = View::make('payment.edit');
	
			$acct_options=V_account::getList();//费用科目列表
			$cctr_options=V_cctr::getList();//成本中心列表
	
			$row_count = count($payment->allocations);
			$view->with('cctr_options', $cctr_options)->with('row_count',$row_count)
			->with('acct_options',$acct_options)->with('payment',$payment);
			return $view;
		}
    
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
  			//Debugbar::info($request);
  			//Debugbar::info( Input::get('related_pmt_id'));
  			
  			//定义规则
  			
  			 $rules = array(
  			 'vendor_name'=>'required',
  			 'bank_info'=>'required|alpha_dash|between:1,999',
  			 'amount'=>'required|numeric|between:0,99999999',
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
  			
  			$validator = Validator::make(
    				array('amount'=>Input::get('amount')),
    				array('amount'=>'in:'.$amount_allocated)
    			);
    		if($validator->fails()) {
  				
  				return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
  			  		
  			}
  				
  			//	提交数据
  			
  			//$payment = new Payment();
  			
  			
  			$pmt = DB::transaction(function(){
  				if(Input::has('is_downpayment')){ //判断是否预付款
  				
  					$pmt_type=-1;
  				}else{
  					$pmt_type=1;
  				}	
  			
  				if(Input::has('row_count')){
  					$row_count=intval(Input::get('row_count'));
  				}
  					
  				
  				
  				$vendor_name = Input::get('vendor_name');
  				$vendor_id = DB::table('vendors')->where('vendor_name',$vendor_name)->pluck('id');
  				$related_pmt_id = 0;
  				if(Input::has('related_pmt_id')){
  					$related_pmt_id=intval(Crypt::decrypt(Input::get('related_pmt_id')));
  				} 
  				$payment = Payment::create(array(
  					'pmt_code' => Self::generate_pmt_code($pmt_type),
  					'payee_id' => $vendor_id,
  					'vendor_name'=>$vendor_name,
  					'bank_info'=>Input::get('bank_info'),
  					'payer_id' => 1,
  					'amount' => floatval(Input::get('amount')),
  					'created_by_user' => Sentry::getUser()->id, 
  					'currency' => 1,
  					'vat_amount' => floatval(Input::get('vat_amount')),
  					'type' => $pmt_type,
  					'related_pmt_id' => $related_pmt_id,
  					'invoice_code' => Input::get('invoice_code'),
  					'status' => 1,
  					'order_number' => Input::get('order_number'),
  					'pmt_due_date' => Input::get('pmt_due_date'),
  					'urgency' => 0,
  					'description' => Input::get('description'),
  					'memo'=> Input::get('memo'),
  					'attachement' => '',
  					));
  					
  				if(!$payment){
  					throw new \Exception('数据提交没有成功！');
  				}
  				
  				$pid=$payment->id;
  				if($related_pmt_id<>0){//关联相关预付款
  				
  					$related_pmt = Payment::find($related_pmt_id);
  					if($related_pmt){
  						
  						$related_pmt->related_pmt_id = $pid;
  						$related_pmt->save();
  					
  					}
  				
  				}
  				if(Input::hasFile('attachement')){ 
  					//附件上传
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
  				
  				
  				for ($i=1;$i<=$row_count;$i++){
  					
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
    			
    			$approvers = self::findApprovers($pid);
    			//Debugbar::info($pid);
    			//Debugbar::info($approvers);
    			//echo $approvers;
  				$n=1;
  				foreach($approvers as $approver){
  				
  					$pmtapprovals = new Payment_approval;
  					$pmtapprovals->pmt_id = $pid;
  					$pmtapprovals->approver_id = $approver;
  					if($n===1){
  						$payment->reviewer_id = $approver;
  						$payment->save();
  					}
  					$pmtapprovals->serial_no = $n;
  					$n++;
  					$pmtapprovals->status = 1;
  					$pmtapprovals->save();
  			
  				}
  				
  				
  			return $payment;	
  			
  			});
  			
  			return \View::make('payment.summary')->with('payment',$pmt);
  								
  	}
  }
 
	public function index(){
		$uid = Sentry::getuser()->id;
		$payments = Payment::with('approvals')->where('created_by_user','=',$uid)->orderby('created_at','desc')->paginate(10);
		return \View::make('payment.index')->with('payments',$payments);
	
	}
	
	public function show($id) {
	
		$uid=Crypt::decrypt($id);
		$payment = Payment::with('allocations','attachements','approvals')->find($uid);
		$acct_options = V_account::getList();//费用科目列表
  		$cctr_options=V_cctr::getList();//成本中心列表
  		$attachement_list=[];
  		$i=0;
		foreach($payment->attachements as $attachement){
			$attachement_list = array_add($attachement_list,$i,[$attachement->voucher->originalFilename(),
			$attachement->voucher->url()]);
			$i++;
		}
		return \View::make('payment.show')->with('payment',$payment)->with('attachement_list',$attachement_list)
		->with('cctr_options', $cctr_options)->with('acct_options',$acct_options);
	
	}  
	
	public function update($id) {
	
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
  			 'vendor_name'=>'required',
  			 'bank_info'=>'required|alpha_dash|between:1,999',
  			 'amount'=>'required|numeric|between:0,99999999',
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
  			
  			$validator = Validator::make(
    				array('amount'=>Input::get('amount')),
    				array('amount'=>'in:'.$amount_allocated)
    			);
    		if($validator->fails()) {
  				
  				return Redirect::route('payment.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
  			  		
  			}
  				
  			//	提交数据
  			
  			//$payment = new Payment();
  			
  			$pmt = DB::transaction(function(){
  				if(Input::has('is_downpayment')){ //判断是否预付款
  				
  					$pmt_type=-1;
  				}else{
  					$pmt_type=1;
  				}	
  			
  				if(Input::has('row_count')){
  					$row_count=intval(Input::get('row_count'));
  				}
  					
  				
  				
  				$vendor_name = Input::get('vendor_name');
  				$vendor_id = DB::table('vendors')->where('vendor_name',$vendor_name)->pluck('id');
  				//if(is_null($vendor_id)){$vendor_id=0;}
  				$vendor_id=0;
  				$payment = Payment::create(array(
  					'pmt_code' => Self::generate_pmt_code($pmt_type),
  					'payee_id' => $vendor_id,
  					'vendor_name'=>$vendor_name,
  					'bank_info'=>Input::get('bank_info'),
  					'payer_id' => 1,
  					'amount' => floatval(Input::get('amount')),
  					'created_by_user' => Sentry::getUser()->id, 
  					'currency' => 1,
  					'vat_amount' => floatval(Input::get('vat_amount')),
  					'type' => $pmt_type,
  					'invoice_code' => Input::get('invoice_code'),
  					'status' => 1,
  					'order_number' => Input::get('order_number'),
  					'pmt_due_date' => Input::get('pmt_due_date'),
  					'urgency' => 0,
  					'description' => Input::get('description'),
  					'memo'=> Input::get('memo'),
  					'attachement' => '',
  					));
  					
  				if(!$payment){
  					throw new \Exception('数据提交没有成功！');
  				}
  				
  				$pid=$payment->id;
  				
  				if(Input::hasFile('attachement')){ 
  					//附件上传
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
  				
  				
  				for ($i=1;$i<=$row_count;$i++){
  					
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
    			
    			$approvers = self::findApprovers($pid);
    			//Debugbar::info($pid);
    			//Debugbar::info($approvers);
    			//echo $approvers;
  				$n=1;
  				foreach($approvers as $approver){
  				
  					$pmtapprovals = new Payment_approval;
  					$pmtapprovals->pmt_id = $pid;
  					$pmtapprovals->approver_id = $approver;
  					if($n===1){
  						$payment->reviewer_id = $approver;
  						$payment->save();
  					}
  					$pmtapprovals->serial_no = $n;
  					$n++;
  					$pmtapprovals->status = 1;
  					$pmtapprovals->save();
  			
  				}
  				
  				
  			return $payment;	
  			
  			});
  			
  			return \View::make('payment.summary')->with('payment',$pmt);
  								
  	}
  	
  		if(Input::has('delete')){
  		
  			$uid=Crypt::decrypt($id);
			$payment = Payment::find($uid);
			$payment->delete();
			return Redirect::route('payment.index');
  		
  		}
	
	}
	
	public function destroy($id) {
		
		$uid=Crypt::decrypt($id);
		$payment = Payment::find($uid);
		if(Input::has('recall')){
			$payment->status = 0;
			$payment->save();
			Notification::success('The Payment '.$payment->id.' has been recalled successfully!');
			return Redirect::route('payment.index');
			
		}
		if(Input::has('delete')){
		
			$payment->delete();
			
		}
		
	}
	
	public function start(){
	
		return View::make('payment.start');
	}
	
	public static function findApprovers($pmtid){
	
		$pmt = Payment::find($pmtid);
		$applicant_id = $pmt->created_by_user;
		$approvers_list=[];
		$arr_cctrs = $pmt->cctrs;
		$arr_accounts = $pmt->accounts;
		$i=0;
		foreach($arr_cctrs as $cctr){
		// get CCTR approvers who meets the approval limit or flaged "Mandatory"
			$cctr_amount = Allocation::where('cctr_id','=',$cctr->id)->where('pmt_id','=',$pmtid)->sum('amount_final');
			
			$approvers_1 = DB::table('controls')
			->select('Authority_user')
			->whereRaw('(activated=1 and control_id ='.$cctr->id.' and control_type_id=1 and authority_user<>'.$applicant_id.
			') and ((approval_start<'.$cctr_amount.' and approval_limit>='.$cctr_amount.') or (mandatory=1))')
			->orderBy('approval_level')->distinct()->lists('Authority_user');
			
			foreach($approvers_1 as $approver){
				
				$approvers_list = array_add($approvers_list,$i,$approver);
				$i++;
			
			}
			
		}
		
		if(($approvers_list)==[]){
			$approver = DB::table('user_profiles')->where('user_id',$applicant_id)->pluck('approver_id');
			$approvers_list = array_add($approvers_list,$i,$approver);
		}
		
		foreach($arr_accounts as $account){
			// get accounts approvers who meets the approval limit or flaged "Mandatory"
			$acct_amount = Allocation::where('acct_id','=',$account->id)->where('pmt_id','=',$pmtid)->sum('amount_final');
			$approvers_2 = DB::table('controls')
			->select('Authority_user')->whereRaw('(activated=1 and control_id ='.$account->id.' and control_type_id=2 and authority_user<>'.$applicant_id.
			') and ((approval_start<'.$acct_amount.' and approval_limit>='.$acct_amount.') or (mandatory=1))')
			->orderBy('approval_level')->distinct()->lists('Authority_user');
			
			foreach($approvers_2 as $approver){
				
				$approvers_list = array_add($approvers_list,$i,$approver);
				$i++;
			
			}
			
			
		}
		//Debugbar::info($approvers_list);
		
		return array_unique($approvers_list);
	}
	
	public function downpayments($vendor_name){
	
		$payments = Payment::downpayments()->where('related_pmt_id',0)->where('status','>',0)
		->where('vendor_name',$vendor_name)->where('created_by_user',Sentry::getuser()->id)->orderby('created_at','desc')->paginate(5);
		return \View::make('payment.downpayments')->with('payments',$payments);
	
	
	}
	
	private function generate_pmt_code($type){
		$type_code = "N/A";
		$yearmonth = strval(Date("Y").Date("m"));
		switch ($type){
		
			case -1: //downpayment
				$type_code = 'DP'.$yearmonth;
			break;
			case 1: // IM, invoice management/payments to 3rd party vendor
				$type_code = 'IM'.$yearmonth;
			break;
			case 2: //reimbursement,travel claims
				$type_code = 'TR'.$yearmonth;
			break;
			
		}
		
		$serial_record = Count::where('Year_Month',$yearmonth)->first();
		
		if($serial_record){
			
			$serial_no = intval($serial_record->serial_no)+1;
			$serial_record->serial_no = $serial_no;
			$serial_record->save();
			
		}else{
			
			$serial_record = new Count();
			$serial_record->Year_Month = $yearmonth;
			$serial_record->serial_no = 1;
			$serial_record->save();
			$serial_no=1;
			
		}
		
		return $type_code.strval(10000+$serial_no);
	}
	
	
	
	public function missingMethod($parameters = array()){
    //
	}
 
}
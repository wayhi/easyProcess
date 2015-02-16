<?php

namespace App\Controllers\approval;
use Sentry,Payment,Allocation, Payment_approval,View, Input,Crypt, Redirect, V_account,V_cctr,DB, Debugbar;
class ApproveController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /approve
	 *
	 * @return Response
	 */
	public function index()
	{
		$uid = Sentry::getuser()->id;
		$payments = Payment::with('creator')->where('reviewer_id','=',$uid)->orderby('created_at','desc')->paginate(10);
		return \View::make('approval.index')->with('payments',$payments);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /approve/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /approve
	 *
	 * @return Response
	 */
	public function store()
	{
		//
		//Debugbar::info(Input::get('pmt_chk'));
		$current_user_id = Sentry::getuser()->id;
		if(Input::has('approve')){
			$action = 'approve';
		}
		if(Input::has('reject')){
			$action = 'reject';
		}
		
		if(Input::has('pmt_chk')){
			$n = count(Input::get('pmt_chk'));
			for($i=0;$i<$n;$i++){
				$uid = Crypt::decrypt(Input::get('pmt_chk')[$i]);
				$payment=Payment::with('approvals')->find($uid);
				if($current_user_id<>$payment->reviewer_id){
					echo 'Not Authorized';
				}else{
					$approval_complete=0;
					//$approvers_count = count($payment->approvals);
					$k=0;
					foreach($payment->approvals as $approval){
						if($approval_complete==1){
							if($action == 'approve'){
								$payment->reviewer_id = $approval->approver_id;
								$payment->status=1;
								$payment->save();
								$k=$approval->serial_no;
							}		
							
							break;		
						}
						
						
						if($current_user_id==$approval->approver_id){
							switch($action){
								case 'approve':
									$approval->status=2;
									$approval->save();
									$approval_complete=1;
									break;
								case 'reject':
									$approval->status=-1;
									$approval->save();
									$payment->status=-1;
									$payment->reviewer_id = 0;
									$payment->save();
									$approval_complete=1;
									$k=-1;
									break;
							}
							
						}
					
					}
					if($k==0){
						$payment->reviewer_id = 0;
						$payment->status = 2; //所有审批完成
						$payment->save();
											
					}	
				}
			}
			
		}
		
		return Redirect::route('approval.index');
	}

	/**
	 * Display the specified resource.
	 * GET /approve/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /approve/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
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
		$actual_ttl = self::getActualYTDExp($uid,2015);
		$budget_fullyear = self::getBudget_Fullyear($uid,2015);
		$cctrs = $payment->cctrs;
		$k=0;
		foreach ($cctrs as $cctr){
			$chart_js_data_budget[$k] = 'data:['.(string)($budget_fullyear[$cctr->id]/1000).','.'0]';
			$chart_js_data_actual[$k] = 'data: ['.(string)($actual_ttl[$cctr->id]/1000).','.(string)($actual_ttl[$cctr->id]/1000).']';
			$k++;
		}
		
		Debugbar::info($budget_fullyear);
		Debugbar::info($actual_ttl);
		
		/*
		$actual_acct = self::getActualByAcctandCctr($uid,2015);
		list($cctr_ids,$actualbyaccts) = array_divide($actual_acct);
		list($acctids,$actuals) = array_divide($actualbyaccts[0]);
		$chart_js_label = "labels: ['Total'";
		for($i=0;$i<count($acctids);$i++){
			$v = $acct_options[$acctids[$i]];
			$v = substr($v,0,strpos($v,'-'));
			$chart_js_label = $chart_js_label.",'".$v."'";
		
		}
		$chart_js_label = $chart_js_label."],";
		//list($cctr_ids,$actualbyaccts) = array_divide($actual_acct);
		*/
		return \View::make('approval.edit')->with('payment',$payment)->with('attachement_list',$attachement_list)
		->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)->with('actual',$chart_js_data_actual)->with('budget',$chart_js_data_budget);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /approve/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$uid=Crypt::decrypt($id);
		$payment = Payment::with('approvals')->find($uid);
		$actions = '';
		if(!$payment){
			return redirect::route('login');
		}else{
			if(Input::has('approve')){
				$action = 'approve';
			}
			if(Input::has('reject')){
				$action = 'reject';
			}
			if(Input::has('approve_forward')){
				$action = 'approve_forward';
				$approvers_to_be_added = Input::get('approver_id');
				$number_of_approvers = count($approvers_to_be_added);
			}
			$current_user_id = Sentry::getuser()->id;
			if($current_user_id<>$payment->reviewer_id){
					echo 'Not Authorized';
				}else{
					$approval_complete=0;
					$k=0;
					foreach($payment->approvals as $approval){
						if($approval_complete==1){
							if($action == 'approve'){
								$payment->reviewer_id = $approval->approver_id;
								$payment->status=1;
								$payment->save();
								$k=$approval->serial_no;
								break;	
							}
							
							if($action == 'approve_forward'){
							
								$approval->serial_no +=  $number_of_approvers;
								$approval->save();
							
							}	
							
								
						}
						
						
						if($current_user_id==$approval->approver_id){
							switch($action){
								case 'approve':
									$approval->status=2;
									$approval->comment = Input::get('comment');
									$approval->save();
									$approval_complete=1;
									break;
								case 'reject':
									$approval->status=-1;
									$approval->comment = Input::get('comment');
									$approval->save();
									$payment->status=-1;
									$payment->reviewer_id = 0;
									$payment->save();
									$approval_complete=1;
									$k=-1;
									break;
								case 'approve_forward':
									$approval->status=2;
									$approval->comment = Input::get('comment');
									$approval->save();
									$approval_complete=1;
									$k=$approval->serial_no+1;
									break;	
							}
							
						}
					
					}
					if($k==0){
						$payment->reviewer_id = 0;
						$payment->status = 2; //所有审批完成
						$payment->save();
											
					}
					if($k>0 && $action=='approve_forward'){
						$payment->reviewer_id = $approvers_to_be_added[0];
						$payment->status=1;
						$payment->save();
						for($i=0;$i<$number_of_approvers;$i++){//从位置$k开始插入新增加的审批人
							$approval = new Payment_approval();
							$approval->approver_id = $approvers_to_be_added[$i];
							$approval->pmt_id = $payment->id;
							$approval->serial_no = $k;
							$approval->status=1;
							$approval->comment = '(由'.Sentry::getuser()->last_name.'转发)';
							$approval->save();
							$k +=1;
						}
						
					}
					return redirect::route('approval.index');	
				}
			
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /approve/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
	
	public function budget_chart(){
	
		return view::make('approval.budget_chart');
	
	}
	
	private function getActualYTDExp($pmtid,$year){
		//YTD actual expenses by cost center according to the Payment provided
		
		$pmt = Payment::find($pmtid);
		$costcenters = $pmt->cctrs;
		//$accounts = $pmt->accounts;
		$ttl_amount=[];
		$allocations = Allocation::whereIn('pmt_id',Payment::where(DB::raw('year(created_at)'),$year)->where('status','>',0)->lists('id'));
		$ttl_amount = $allocations->whereIn('cctr_id',$costcenters->lists('id'))->groupby('cctr_id')->select('cctr_id',DB::raw('sum(amount_final) as amount'))->lists('amount','cctr_id');
		
		return $ttl_amount;
	
	}
	
	private function getBudget_Fullyear($pmtid,$year){
	
		$pmt = Payment::find($pmtid);
		$costcenters = $pmt->cctrs;
		$budget_fullyear=[];
		foreach($costcenters as $cctr){
			$budget_fullyear = array_add($budget_fullyear,$cctr->id,$cctr->budget_fullyear($year));
		}
		
		return $budget_fullyear;
	}
	
	private function getActualByAcctandCctr($pmtid,$year){
		//YTD actual expenses by cost centers & Accounts according to the Payment provided
		
		
		$pmt = Payment::find($pmtid);
		$costcenters = $pmt->cctrs;
		$accounts = $pmt->accounts;
		$acct_amounts=[];
		$allocations = Allocation::whereIn('pmt_id',Payment::where(DB::raw('year(created_at)'),$year)->where('status','>',0)->lists('id'));
		foreach ($costcenters as $cctr){
		
		 $amount_tmp = $allocations->where('cctr_id',$cctr->id)->whereIn('acct_id',$accounts->lists('id'))->groupby('acct_id')->select('acct_id',DB::raw('sum(amount_final) as amount'))->lists('amount','acct_id');
		 $acct_amounts =array_add($acct_amounts,$cctr->id,$amount_tmp);
		
		}
		return $acct_amounts;
	}
	
	

}
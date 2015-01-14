<?php
namespace App\Controllers\Admin;
use View, Input, V_account, V_cctr, User,Redirect, Control,Validator;
class ApprovalController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET //admin/approval
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET //admin/approval/create
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$view=View::make('admin.approval');
			
  		if(Input::has('row_count')){
  			$row_count = intval(Input::get('row_count'));
  			
  		}else{
  			$row_count =1;
  	
  		}
  		
  		if(Input::has('control_type') {
  			$control_type_id = intval(Input::get('control_type'));
  			$control_id = intval(Input::get('control_id'));
  			$controls=Control::with('control','belongsToUser')->where('control_type_id','=',$control_type_id)
  			->where('control_id','=',$control_id)->orderBy('approvel_level')->get();
  			$i=0;
  			
  			foreach($controls as $control){
  				$control_name = array_add($control_name,''.$i,$control->control->cctr_code);
  				$authority_user = array_add($authority_user,''.$i,$control->user->last_name);
  			
  			}
  		}
  		
  		
  		
  		$acct_options = V_account::getList();//费用科目列表
  		$cctr_options=V_cctr::getList();//成本中心列表
  		$user_options=User::activated()->orderBy('last_name')->lists('last_name','id');
  		$view->with('user_options',$user_options)->with('row_count',$row_count)->with('cctr_options',$cctr_options);
  	
  		return $view;
  	
	}

	/**
	 * Store a newly created resource in storage.
	 * POST //admin/approval
	 *
	 * @return Response
	 */
	public function store()
	{
	
		if(Input::has('submit')){//提交表单
			//定义规则
  			
  			 $rules = array(
  			 'approval_limit'=>'required|numeric',
  			 
  			 );
			//验证主表字段
    		$validator = Validator::make(Input::all(), $rules);
    		if($validator->fails()) {
  				//Former::withErrors($validator);
  				return Redirect::route('admin.approval.create',array('row_count'=>$row_count))->withInput()
  				->withErrors($validator);
			}
    		
    		$control = new Control;
    		$control_type_id = intval(Input::get('control_type'));
    		$control->control_type_id = $control_type_id;
    		switch($control_type_id){
    			case 1:
    				$control->control_type = 'Cctr';
    			break;
    			case 2:
    				$control->control_type = 'Account';
    			break;
    			default:
    				$control->control_type = '';
    		}
    		$control->control_id = intval(Input::get('control_id'));
    		$control->authority_user = intval(Input::get('authority_user'));
    		$control->approval_limit = floatval(Input::get('approval_limit'));
    		$control->approval_level = intval(Input::get('approval_level'));
    		if(Input::has('mandatory')){
  				
  				$control->mandatory = 1;
  				
  			}else{
  					
  				$control->mandatory = 0;
  			}	
    		
    		if(Input::has('activated')){
  				
  				$control->activated = 1;
  				
  			}else{
  					
  				$control->activated = 0;
  			}	
    		
    		$control->save();
    		if(!$control){
  					throw new \Exception('数据提交没有成功！');
  			}
    		
			return Redirect::route('admin.approval.create')->withInput();
		
		
		}
	
		
	}

	/**
	 * Display the specified resource.
	 * GET //admin/approval/{id}
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
	 * GET //admin/approval/{id}/edit
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
	 * PUT //admin/approval/{id}
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
	 * DELETE //admin/approval/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}


<?php
namespace App\Controllers\Admin;
use View, Input, V_account, V_cctr, User,Redirect, Control,Validator,Debugbar,Crypt;
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
		
  		$control_type_id=0;
  		$control_id =0;
  		$user_options=User::activated()->orderBy('last_name')->lists('last_name','id');
  		
  		if(Input::has('control_type_id')) {
  			$control_type_id = intval(Input::get('control_type_id'));
  			$control_id = intval(Input::get('control_id'));
  			$controls=Control::with('user')->where('control_type_id','=',$control_type_id)
  			->where('control_id','=',$control_id)->orderBy('approval_level')->get();
  			
  			switch($control_type_id){
  		
  				case 1:$options=V_cctr::getList();//成本中心列表
  				break;
  				case 2:$options = V_account::getList();//费用科目列表
  				break;
  				default:$options=[''];
  			
  			}
  		
  		
  		
  		return $view->with('user_options',$user_options)
  		->with('controls',$controls)
  		->with('options',$options);
  			
  		}else{
  			
  			return $view->with('user_options',$user_options)
  			->with('options',V_cctr::getList());
  		
  		}
  		
  		
  		
  		
  		
  	
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
			
    		
    		$control_type_id = intval(Input::get('control_type'));
    		$control_id = intval(Input::get('control_id'));
    		//定义规则
  			
  			 $rules = array(
  			 'approval_limit'=>'required|numeric',
  			 
  			 );
			//验证字段
    		$validator = Validator::make(Input::all(), $rules);
    		if($validator->fails()) {
  				//Former::withErrors($validator);
  				return Redirect::route('admin.approval.create',['control_type_id'=>$control_type_id,'control_id'=>$control_id])
  				->withInput()
  				->withErrors($validator);
			}
    		
    		$control = new Control;
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
    		
    		$control->control_id = $control_id;
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
    		
			return Redirect::route('admin.approval.create',['control_type_id'=>$control_type_id,'control_id'=>$control_id])->withInput();
		
		
		}
		
		if(Input::has('refresh')){
		
			$control_type_id = intval(Input::get('control_type'));
    		$control_id = intval(Input::get('control_id'));
			return Redirect::route('admin.approval.create',['control_type_id'=>$control_type_id,'control_id'=>$control_id])->withInput();
		
		}
		
		if(Input::has('delete')){
			echo("ok");
			//Debugbar::info(request);
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
		echo('show');
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
		echo('edit');
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
		
		$uid=Crypt::decrypt($id);
		$control=Control::find($uid);
		if($control){
			$control->delete();
		}
		if(Input::has('control_type_id')){
			$control_type_id = Input::get('control_type_id');
		}
		
		if(Input::has('control_id')){
			$control_id = Input::get('control_id');
		}
		return redirect::route('admin.approval.create',['control_type_id'=>$control_type_id,'control_id'=>$control_id]);
	}
	
	

}


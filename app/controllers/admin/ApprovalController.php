<?php
namespace App\Controllers\Admin;
use View, Input, V_account, V_cctr, User;
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
  			//$cctr_1 = intval(Input::get('cctr_1'));
  		}else{
  			$row_count =1;
  	
  		}
  	
  		$acct_options = V_account::getList();//费用科目列表
  		$cctr_options=V_cctr::getList();//成本中心列表
  		$user_options=User::activated()->orderBy('last_name')->lists('last_name','id');
  		$view->with('cctr_options', $cctr_options)->with('acct_options',$acct_options)
  		->with('user_options',$user_options)->with('row_count',$row_count);
  	
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
		//
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
<?php

namespace App\Controllers\approval;
use Sentry,Payment,View;
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
		$payments = Payment::with('approvals')->where('reviewer_id','=',$uid)->orderby('created_at','desc')->paginate(10);
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
		//
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
		//
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
		//
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

}
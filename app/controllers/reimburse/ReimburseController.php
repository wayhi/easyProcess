<?php
namespace App\Controllers\reimburse;

use V_cctr,V_account,Payment,Allocation,Notification,Attachement,Control,Count;
use Input, Redirect, Sentry, View, Validator, DB, Crypt, Payment_approval;

class ReimburseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /reimburse/reimburse
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /reimburse/reimburse/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('reimbursement.new_report');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /reimburse/reimburse
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /reimburse/reimburse/{id}
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
	 * GET /reimburse/reimburse/{id}/edit
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
	 * PUT /reimburse/reimburse/{id}
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
	 * DELETE /reimburse/reimburse/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
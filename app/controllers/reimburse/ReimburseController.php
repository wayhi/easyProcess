<?php
namespace App\Controllers\reimburse;

use Allocation,Notification,Attachement,Control,Count,Expense,Exp_group;
use Input, Redirect, Sentry, View, Validator, DB, Crypt, Reimbursement, Payment_approval;

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
		if(Input::has('save')){
			$rules = array(
  			 'exp_date'=>'required|date',
  			 'exp_amount'=>'required|numeric|between:0,99999999',
  			 'exp_venue'=>'required|max:255',
  			 );

			$validator = Validator::make(Input::all(), $rules);
    		if($validator->fails()) {
  				//Former::withErrors($validator);
  				return Redirect::route('reimburse.expense_input',['expense_id'=>Input::get('exp_type')])->withInput()
  				->withErrors($validator);

			}

			$reimbursement = New Reimbursement();
			$reimbursement->expense_id = intval(Input::get('exp_type'));
			$reimbursement->owner_id = Sentry::getUser()->id;
			$reimbursement->currency_id = intval(Input::get('exp_currency'));
			$reimbursement->amount = floatval(Input::get('exp_amount'));
			$reimbursement->transaction_date = Input::get('exp_date');
			$reimbursement->venue = Input::get('exp_venue');
			$reimbursement->purpose = Input::get('exp_purpose');
			$reimbursement->save();
			return Redirect::route('reimburse.create');

		}


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

	public function expense_list()
	{
		//echo "ok";
		$exp_groups = Exp_group::with('expenses')->get();
		return View::make('reimbursement.expense_list')->with('exp_groups',$exp_groups);

	}

	public function expense_input($id)
	{

		return View::make('reimbursement.expense_input')->with('expense_id',$id);



	}

}
<?php
namespace App\Controllers\Admin;
use View, Input;
class /admin/ApprovalController extends \BaseController {

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
		return View::make('admin.approval');
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
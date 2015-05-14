<?php

class Expense extends \Eloquent {
	protected $table = 'expenses';
	protected $guarded = array('id');

	
	public function group(){
	
		return $this->belongsTo('Exp_group','group_id','id');
	
	}
}
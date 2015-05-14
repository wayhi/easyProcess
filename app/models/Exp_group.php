<?php

class Exp_group extends \Eloquent {
	protected $table = 'exp_group';
	protected $guarded = array('id');

	
	public function expenses(){
	
		return $this->hasMany('Expense','group_id','id');
	
	}
}
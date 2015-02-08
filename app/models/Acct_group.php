<?php

class Acct_group extends \Eloquent {
	protected $fillable = [];
	protected $protected = 'acct_group';
	
	
	public function accounts(){
	
		return $this->hasMany('Account','group_id','id');
	
	}
	
	public function budget(){
		
		return $this->hasMany('Budget','acct_group_id','id');
	
	}
}
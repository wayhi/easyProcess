<?php

class Account extends \Eloquent {
	protected $table = 'accounts';
	protected $fillable = [];
	
	
	public function controls(){
	
		return $this->morphMany('Control','control');
	
	}
	
	public function group(){
	
		return $this->belongsTo('Acct_group','group_id','id');
	
	}
}
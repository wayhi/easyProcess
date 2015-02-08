<?php

class Budget extends \Eloquent {
	protected $table = 'budget_data';
	protected $fillable = [];
	
	
	public function cctr(){
	
		return $this->belongsTo('Cctr','cctr_id','id');
	
	}
	
	public function acct_group(){
	
		return $this->belongsTo('Acct_group','acct_group_id','id')
	
	
	}
}
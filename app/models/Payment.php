<?php

class Payment extends \Eloquent {
	protected $table='payments';
	//protected $fillable = ['*'];
	protected $guarded = array('id');
	
	
	public function allocations(){
	
		return $this->hasMany('Allocation','pmt_id');
	}
	
	
	public function attachements(){
	
		return $this->hasMany('Attachement','parent_id');
		
	}
	
	public function cctrs(){
		
		return $this->belongsToMany('Cctr','Allocations','pmt_id','cctr_id');
	
	}
	
	public function accounts(){
	
		return $this->belongsToMany('Account','Allocations','pmt_id','acct_id');
	}
	
	
}
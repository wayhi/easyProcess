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
	
	
	
	
	
	
}
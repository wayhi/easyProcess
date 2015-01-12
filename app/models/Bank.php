<?php

class Bank extends \Eloquent {
	protected $table = 'banks';
	protected $guarded = array('id');
	
	
	public function belongsToVendor(){
		
		return $this->belongsTo('Vendor','vendor_id','id');
	
	}
	
	
}
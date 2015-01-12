<?php

class Vendor extends \Eloquent {
	protected $table = 'vendors';
	protected $guarded = array('id');
	
	public function banks(){
	
		return $this->hasMany('Bank','vendor_id','id');
	}
	
	
	
	
	
}
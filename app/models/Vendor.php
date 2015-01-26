<?php

class Vendor extends \Eloquent {
	protected $table = 'vendors';
	protected $guarded = array('id');
	
	public function banks(){
	
		return $this->hasMany('Bank','vendor_id','id');
	}
	
	public function payments(){
	
		return $this->hasMany('Payment','payee_id','id');
	
	}
	
	
	
}
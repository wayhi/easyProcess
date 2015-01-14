<?php

class Allocation extends \Eloquent {
	protected $table = 'allocations';
	protected $guarded = ['id'];
	
	
	public function belongsToPayment(){
	
		return $this->belongsTo('Payment','pmt_id','id');
	
	}
}

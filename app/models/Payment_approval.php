<?php

class Payment_approval extends \Eloquent {
	protected $fillable = [];
	protected $table='pmt_approvals';
	public function payment(){
	
		return $this->belongsTo('Payment','pmt_id','id');
	
	}
}
<?php

class Payment extends \Eloquent {

	use SoftDeletingTrait;
	protected $table='payments';
	//protected $fillable = [''];
	protected $guarded = array('id');
	

    protected $dates = ['deleted_at'];
	
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
	
	public function approvals(){
	
		return $this->hasMany('Payment_approval','pmt_id','id')->orderby('pmt_approvals.serial_no');
	}
	
	public function creator(){
	
		return $this->belongsTo('User','created_by_user','id');
		
	}
	
	public function payee(){
	
		return $this->belongsTo('Vendor','payee_id','id');
	}
	
	public function approvers(){
	
		return $this->belongsToMany('User','pmt_approvals','pmt_id','approver_id')->orderby('pmt_approvals.serial_no');
	}
	
	public function scopeDownpayments($query){
		
		return $query->where('type',-1);
	
	}
}
<?php

class Reimbursement extends \Eloquent {
	protected $table = 'reimbursements';
	
	protected $guarded = ['id'];

	public function scopeByOwner($query, $owner_id){

        return $query->where('owner_id',$owner_id);

    }

    public function exp_belongsTo(){


    	return $this->belongsTo('Expense','expense_id','id');

    }
	
	
}
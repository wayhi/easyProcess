<?php

class Cctr extends \Eloquent {
	protected $table = 'cctrs';
	protected $fillable = [];
	
	
	public function controls(){
	
		return $this->morphMany('Control','control');
	
	}
	
	public function budget_fullyear($year){
	
		return $this->hasMany('Budget','cctr_id','id')->where('budget_data.year',$year)
		->select(DB::raw('sum(budget_amount) as budget'))->pluck('budget');
		
	}
	
	public function budget_YTD($year,$month){
		return $this->hasMany('Budget','cctr_id','id')
		->where('budget_data.year',$year)
		->where('budget_data.month','<=',$month)
		->select(DB::raw('sum(budget_amount) as budget'))->pluck('budget');
	
	}
	
	
}
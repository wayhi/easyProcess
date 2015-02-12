<?php

class Cctr extends \Eloquent {
	protected $table = 'cctrs';
	protected $fillable = [];
	
	
	public function controls(){
	
		return $this->morphMany('Control','control');
	
	}
	
	public function budget(){
	
		return $this->hasMany('Budget','cctr_id','id');
		
	}
	
	
}
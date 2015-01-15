<?php

class Account extends \Eloquent {
	protected $table = 'accounts';
	protected $fillable = [];
	
	
	public function controls(){
	
		return $this->morphMany('Control','control');
	
	}
}
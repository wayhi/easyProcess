<?php

class Control extends \Eloquent {
	protected $table = 'controls';
	protected $fillable = [];
	
	public function control(){
		
		return this->morphTo();
	
	
	}
}
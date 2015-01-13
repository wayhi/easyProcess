<?php

class Cctr extends \Eloquent {
	protected $table = 'cctrs';
	protected $fillable = [];
	
	public function controls(){
	
		return this->morphMany('Control','control');
	
	}
}
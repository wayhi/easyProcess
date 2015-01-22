<?php

class Control extends \Eloquent {
	protected $table = 'controls';
	protected $fillable = [];
	
	public function control(){
		
		return $this->morphTo();
	
	
	}
	
	public function user(){
	
		return $this->belongsTo('User','authority_user','id');
	
	}
	
	 public function scopeOfType($query, $type){
	 
        return $query->whereType($type);
    }
	
	
	
}
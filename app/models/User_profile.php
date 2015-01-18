<?php

class User_profile extends \Eloquent {
	protected $fillable = [];
	protected $table='user_profiles';
	
	public function owner(){
	
		return $this->belongsTo('User','user_id','id');
		
	}
}
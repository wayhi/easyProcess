<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
	
	
	public function scopeActivated($query){
		
		return $query->where('activated','=','1');
	
	
	}
	
	public function controls(){
		
		return $this->hasMany('Control','authority_user','id');
	}
	
	public function profile(){
		return $this->hasOne('User_profile','user_id','id');
	}
	
	public function payments(){
		return $this->hasMany('Payment','created_by_user','id');
	}
	
	public function approvals(){
		return $this->hasMany('Payment','reviewer_id',id);
	}

}

<?php

class V_account extends \Eloquent {
	protected $table = 'v_account_options';
	protected $fillable = [];
	
	public static function getList(){
		$accts = self::all();// 费用科目
  	
  		if(count($accts)>0 ) {
  				
  			$acct_options = array_combine($accts->lists('id'),  $accts->lists('options'));
  		
  		} else {
  	
  			$acct_options = array(null, 'Not Available');
  		};
  		
  		return $acct_options;
	}
}
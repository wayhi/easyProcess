<?php

class V_cctr extends \Eloquent {
	protected $table = 'v_cctr_options';
	protected $fillable = [];
	
	
	public static function getList(){
	
	//all available cctrs for selective options
	
	$cctrs= self::all();
	
	if(count($cctrs)>0 ) {
  	
  		$cctr_options = array_combine($cctrs->lists('id'), $cctrs->lists('cctr_options'));
  	} else {
  	
  		$cctr_options = array(null, 'Not Available');
  	};
	
	return $cctr_options;
	
	}
}
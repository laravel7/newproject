<?php
/**
 * 
 */
class Config 
{
	
	

	public static function get($path=null){
		if($path){
			$config=$GLOBALS['config'];
			$path= explode('/', $path);
		//	print_r($path);
			foreach ($path as $bit) {
				# code...
				if (isset($config[$bit])) {
					# code...
					$config=$config[$bit];
					//$breaker=1;
					//break;
				}
			/*	else{
					$breaker=0;
				}*/
			}
			/*if($breaker)*/
			return $config;
		}
	}
}
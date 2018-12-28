<?php

/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/28/2018
 * Time: 4:07 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/28/2018 - 4:07 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class request {

	public static function post( array $parameters){
		return (new request)->check($_POST,$parameters);
	}

	public static function get( array $parameters){
		return (new request)->check($_GET,$parameters , true);
	}

	public static function cookie( array $parameters){
		return (new request)->check($_COOKIE,$parameters);
	}

	public static function server( array $parameters){
		return (new request)->check($_SERVER,$parameters);
	}

	public static function all( array $parameters){
		return (new request)->check($_REQUEST,$parameters);
	}

	private function check($data , $parameters , $urlDecode = false ){
		if ( is_array($parameters) ){
			$return = array();
			foreach ( $parameters as $key => $defaultValue ){
				if ( is_int($key)) {
					if (isset($data[$defaultValue])) {
						if ($urlDecode)
							$return[$defaultValue] = urldecode($data[$defaultValue]);
						else
							$return[$defaultValue] = $data[$defaultValue];
					} else {
						$return[$defaultValue] = null ;
					}
				} else {
					if (isset($data[$key]))
						if ( $urlDecode )
							$return[$key] = urldecode($data[$key]);
						else
							$return[$key] = $data[$key];
					else {
						if (isset($defaultValue))
							$return[$key] = $defaultValue ;
					}
				}
			}
			return $return ;
		} else
			return array();
	}
}
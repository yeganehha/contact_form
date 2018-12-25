<?php

namespace App\controller;


/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/25/2018
 * Time: 2:52 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/25/2018 - 2:52 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class httpErrorHandler extends \controller {

	public function __construct() {

	}

	public function E404(){
		parent::view('httpErrorHandler' , array('errorType' => '404'));
	}
	public function E500(){
		parent::view('httpErrorHandler' , array('errorType' => '500'));
	}
}
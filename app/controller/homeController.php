<?php
/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/25/2018
 * Time: 2:33 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/25/2018 - 2:33 PM
 * Discription of this Page :
 */

namespace App\controller;


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class home extends \controller {

	public function __construct() {

	}

	public function index($params = null){
		parent::view('home',$params);
	}
}
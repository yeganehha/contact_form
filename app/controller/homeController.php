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
		//parent::view('home',$params);
		parent::view('home',array('username' => 'erfan'));
	}

	public function edit(){
		$dataGet = \request::post(array('id' => '0', 'firstName' , 'lastName' , 'phone' , 'email'));
		$validate = new \validate($dataGet,array(
			'id' => 'required|notEmpty|number',
			'firstName' => 'required|notEmpty',
			'lastName' => 'required|notEmpty',
			'phone' => 'required|notEmpty|numberFormat:{+98/0/}{91/90/92/93/4X/8X/3X/7X/2X/5X/6X/1X}XXXXXXXX',
			'email' => 'email'
		));
		if ( $validate->isValid() ){
			$validData = $validate->getReturnData() ;
			$model = parent::model('contact');
			$model->setEmail($validData['email']);
			$model->setLastName($validData['lastName']);
			$model->setPhone($validData['phone']);
			$model->setFirstName($validData['firstName']);
			$idOfInsertToDB = $model->insertToDataBase();
			if ( $idOfInsertToDB > 0 ) {
				header('Location: '.HTTP_ROOT.'home/index/insertDone/'.$idOfInsertToDB);
			}
		} else {
			show($validate->getError());
		}
	}
}
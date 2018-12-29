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
		$model = parent::model('contact');
		$listContact = $model->search(array() , ' 1 ' );
		parent::view('home',array('listContent' => $listContact ));
	}

	public function search($params = null){
		$dataGet = \request::get(array('search'));
		$validate = new \validate($dataGet,array(
			'search' => 'required|notEmpty'
		));
		$model = parent::model('contact');
		if ( $validate->isValid() ) {
			$validData = $validate->getReturnData() ;
			$listContact = $model->search(array('%'.$validData['search'].'%','%'.$validData['search'].'%','%'.$validData['search'].'%','%'.$validData['search'].'%'), ' lastName LIKE ? or  firstName LIKE ? or  phone LIKE ? or  email LIKE  ? ');
		} else {
			$listContact = $model->search(array() , ' 1 ' );
		}
		parent::view('home',array('listContent' => $listContact ));
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
			if ( $validData['id'] > 0 )
				$model = parent::model('contact' ,$validData['id']);
			else
				$model = parent::model('contact');
			$model->setEmail($validData['email']);
			$model->setLastName($validData['lastName']);
			$model->setPhone($validData['phone']);
			$model->setFirstName($validData['firstName']);
			if ( $model->getId() > 0 ){
				$resultEdit = $model->upDateDataBase();
				if ( $resultEdit ) {
					header('Location: '.HTTP_ROOT.'home/index/editDone/'. $model->getId());
				}
			} else {
				$idOfInsertToDB = $model->insertToDataBase();
				if ($idOfInsertToDB > 0) {
					header('Location: ' . HTTP_ROOT . 'home/index/insertDone/' . $idOfInsertToDB);
				}
			}
		} else {
			show($validate->getError());
		}
	}

	public function delete(){
		$dataGet = \request::get(array('delete'));
		$validate = new \validate($dataGet,array(
			'delete.*' => 'required|notEmpty'
		));
		$model = parent::model('contact');
		if ( $validate->isValid() ) {
			$validData = $validate->getReturnData() ;
			$listContact = $model->search(array('%'.$validData['search'].'%','%'.$validData['search'].'%','%'.$validData['search'].'%','%'.$validData['search'].'%'), ' lastName LIKE ? or  firstName LIKE ? or  phone LIKE ? or  email LIKE  ? ');
		} else {
			$listContact = $model->search(array() , ' 1 ' );
		}
		parent::view('home',array('listContent' => $listContact ));
	}
}
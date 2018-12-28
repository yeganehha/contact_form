<?php
/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/26/2018
 * Time: 12:21 AM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/26/2018 - 12:21 AM
 * Discription of this Page :
 */

namespace App\model;

if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


interface model {

	public function __construct($searchVariable,$searchWhereClaus);
	public function search($searchVariable, $searchWhereClaus , $tableName  , $fields ) ;
	public function insertToDataBase() ;
	public function upDateDataBase() ;
	public function deleteFromDataBase() ;
	public function returnAsArray() ;
}
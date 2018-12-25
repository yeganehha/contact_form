<?php
/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/25/2018
 * Time: 1:44 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/25/2018 - 1:44 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class controller {

	private static $templates = [];
	protected static function view($template,$params = null ){
		if ( isset(self::$templates[$template]) ){
			self::$templates = array_merge(self::$templates,$params);
		} else
			self::$templates[$template] = $params ;
		return true ;
	}

	public static function generateView(){
		return self::$templates ;
	}

	protected function model($model) {
		if (file_exists(INC_DIR . 'model/' . $model . 'Model.php')) {
			require_once INC_DIR . 'model/' . $model . 'Model.php';
			if (class_exists($model)) {
				return new $model() ;
			} else {
				require_once INC_DIR.'controller/httpErrorHandlerController.php' ;
				App\controller\httpErrorHandler::E500();
				exit;
			}
		} else {
			require_once INC_DIR.'controller/httpErrorHandlerController.php' ;
			App\controller\httpErrorHandler::E500();
			exit;
		}
		require_once INC_DIR.'controller/httpErrorHandlerController.php' ;
		App\controller\httpErrorHandler::E500();
		exit;
	}
}
<?php
/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/24/2018
 * Time: 8:10 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/24/2018 - 8:10 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


class App {

	// default  controller and method if url is empty
	private $controller = 'home';
	private $method = 'index';

	private $params = [];

	public function __construct() {

		$url = $this->generateUrlPrams();
		if ( isset($url[0]) )
			$this->checkControllerIsExist($url[0]);
		if ( isset($url[1]))
			$this->checkMethodIsExist($url[1]);
		$this->getParamasFromUrl($url);

		require_once INC_DIR.'controller/'.$this->controller.'Controller.php' ;

		call_user_func_array([$this->controller, $this->method], $this->params);
	}


	/**
	 * check is controller Exist
	 * @param $controller
	 *
	 * @return bool
	 */
	private function checkControllerIsExist ($controller) {
		if ( !empty($controller)) {
			$controller = trim(strtolower($controller));
			if (file_exists(INC_DIR . 'controller/' . $controller . 'Controller.php')) {
				require_once INC_DIR . 'controller/' . $controller . 'Controller.php';
				if (class_exists($controller)) {
					$this->controller = $controller;
					return true ;
				} else {
					$this->controller = 'httpErrorHandler';
					$this->method = 'E404';
					return false ;
				}
			} else {
				$this->controller = 'httpErrorHandler';
				$this->method = 'E404';
				return false ;
			}
		}
		return true ;
	}


	/**
	 *
	 * @param $method
	 *
	 * @return bool
	 */
	private function checkMethodIsExist($method){
		require_once INC_DIR . 'controller/' . $this->controller . 'Controller.php';
		if (class_exists($method)) {
			$this->method = $method;
			return true ;
		} else {
			$this->controller = 'httpErrorHandler';
			$this->method = 'E404';
			return false ;
		}
	}


	/**
	 * @param $url
	 *
	 * @return mixed
	 */
	private function getParamasFromUrl($url){
		if ( count($url) > 2 ) {
			unset($url[0]);
			unset($url[1]);
			$this->params = $url ;
		}
		return $url ;
	}

	/**
	 * get url and generate to class and methods and prams
	 * @return array
	 */
	private function generateUrlPrams(){
		$url = [] ;
		if ( isset($_GET['urlFromHtaccess']) ){
			$url = explode('/' , trim($_GET['urlFromHtaccess']) );
		}
		return $url ;
	}
}
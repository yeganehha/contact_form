<?php
/**
 * Created by Yeganehha .
 * User: Erfan Ebrahimi (http://ErfanEbrahimi.ir)
 * Date: 12/24/2018
 * Time: 7:58 PM
 * project : contacts
 * virsion : 1.0
 * update Time : 12/24/2018 - 7:58 PM
 * Discription of this Page :
 */


if (!defined('contacts')) die('<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css"><div class="container" style="margin-top: 20px;"><div id="msg_1" class="alert alert-danger"><strong>Error!</strong> Please do not set the url manually !! </div></div>');


define('INC_DIR' , __DIR__.'/');
define('HTTP_ROOT' , 'http://localhost/contacts/');

spl_autoload_register(function ($class_name) {
	if ( substr($class_name, 0 , 6 ) == 'Smarty' )
		return ;
	$class_name = str_replace(['App','\\'],[INC_DIR,'/'] , $class_name). 'Controller.php';
	if ( file_exists($class_name)) {
		require_once $class_name;
	} else {
		require_once INC_DIR.'controller/httpErrorHandlerController.php' ;
		App\controller\httpErrorHandler::E500();
		exit;
	}
});

function show($pram = null , $exit = true ){
	echo '<pre>';
	var_dump($pram);
	echo '</pre>';
	if ( $exit )
		exit;
}

require_once INC_DIR.'core/app.php';
require_once INC_DIR.'core/controller.php';
$configDataBase = require_once INC_DIR.'config.php';
require_once INC_DIR.'core/databaseConection.php';
database::conection($configDataBase);

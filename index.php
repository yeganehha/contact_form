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


define( 'contacts' , 'Erfan Ebrahimi');

require_once __DIR__.'/app/init.php';
$app = new app();
show (controller::generateView());
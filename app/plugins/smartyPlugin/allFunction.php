<?php

$smarty->registerPlugin("function", 'jdateConvertSmarty', 'jdateConvertSmarty');
$smarty->registerPlugin("function", 'jdateAgoConvertSmarty', 'jdateAgoConvertSmarty');
$smarty->registerPlugin("function", 'jdateThenConvertSmarty', 'jdateThenConvertSmarty');
$smarty->registerPlugin("function", 'jdateThenAgoConvertSmarty', 'jdateThenAgoConvertSmarty');
$smarty->registerPlugin("function", 'formating', 'formating');
$smarty->registerPlugin("function", 'formatingNumbers', 'formatingNumbers');
$smarty->registerPlugin("function", 'showPrice', 'showPrice');
$smarty->registerPlugin("function", 'digitToPersainLetters', 'digit_to_persain_letters');
$smarty->registerPlugin("function", 'MoneyToLetters', 'MoneyToLetters');
$smarty->registerPlugin("function", 'showDistance', 'showDistance');
$smarty->registerPlugin("function", 'gravatar', 'gravatar');


function gravatar($params,$smarty){
	$email = $params['email'];
	if ( isset($params['size']) )
		$s = $params['size'];
	else
		$s = 80;
	if ( isset($params['default']) )
		$d = $params['default'];
	else
		$d = 'mp';
	if ( isset($params['rating']) )
		$r = $params['rating'];
	else
		$r = 'g';
	if ( isset($params['rating']) )
		$r = $params['rating'];
	else
		$r = 'g';
	if ( isset($params['getImage']) )
		$img = true;
	else
		$img = false;
	if ( isset($params['attach']) )
		$atts = $params['attach'];
	else
		$atts = array();


	$url = 'https://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}
function showDistance($params, $smarty)
{
	// طبقه بندی بیشتر را به ابتدای لیست اضافه کنید
	$categories = array(
		'سکستیلیون کیلومتر',
		'کوانتینیارد کیلومتر',
		'کوانتینیوم کیلومتر',
		'کادریلیارد کیلومتر',
		'کادریلیون کیلومتر',
		'تریلیارد کیلومتر',
		'تریلیون کیلومتر',
		'بیلیارد کیلومتر',
		'بیلیون کیلومتر',
		'میلیارد کیلومتر',
		'میلیون کیلومتر',
		'هزار کیلومتر',
		'کیلومتر',
		'متر ',
	);

	$Num = $params['distance'];
	//return number_format(round($Num*1000 * 1000 )) ;
	$Num3="";
	$Num2=explode(',',number_format(round($Num*100000 )));

	for($i=0;$i<count($Num2);$i++)
	{
		if($Num2[$i] !=0 )
		{
			$Num3.=($Num2[$i]);
			$Num3.=" ".$categories[count($categories)-count($Num2)+$i]." ";
		}
		if((($i<count($Num2)-1) && ($Num2[$i+1]) != "000")) $Num3.=" و ";

	}

	return $Num3;
}


function showPrice($params, $smarty)
{
	return abs(number_format($params['price']));
}


function digit_to_persain_letters($params)
{
	$money = $params['number'] ;
	$one = array(
		'صفر',
		'یک',
		'دو',
		'سه',
		'چهار',
		'پنج',
		'شش',
		'هفت',
		'هشت',
		'نه');
	$ten = array(
		'',
		'ده',
		'بیست',
		'سی',
		'چهل',
		'پنجاه',
		'شصت',
		'هفتاد',
		'هشتاد',
		'نود',
	);
	$hundred = array(
		'',
		'یکصد',
		'دویست',
		'سیصد',
		'چهارصد',
		'پانصد',
		'ششصد',
		'هفتصد',
		'هشتصد',
		'نهصد',
	);
	$categories = array(
		'',
		'هزار',
		'میلیون',
		'میلیارد',
	);
	$exceptions = array(
		'',
		'یازده',
		'دوازده',
		'سیزده',
		'چهارده',
		'پانزده',
		'شانزده',
		'هفده',
		'هجده',
		'نوزده',
	);

	if(strlen($money) > count($categories)*3){
		throw new Exception('number is longger!');
	}

	$letters_separator = ' و ';
	$money = (string)(int)$money;
	$money_len = strlen($money);
	$persian_letters = '';

	for($i=$money_len-1; $i>=0; $i-=3){
		$i_one = (int)isset($money[$i]) ? $money[$i] : -1;
		$i_ten = (int)isset($money[$i-1]) ? $money[$i-1] : -1;
		$i_hundred = (int)isset($money[$i-2]) ? $money[$i-2] : -1;

		$isset_one = false;
		$isset_ten = false;
		$isset_hundred = false;

		$letters = '';

		// zero
		if($i_one == 0 && $i_ten < 0 && $i_hundred < 0){
			$letters = $one[$i_one];
		}

		// one
		if(($i >= 0) && $i_one > 0 && $i_ten != 1 && isset($one[$i_one])){
			$letters = $one[$i_one];
			$isset_one = true;
		}

		// ten
		if(($i-1 >= 0) && $i_ten > 0 && isset($ten[$i_ten])){
			if($isset_one){
				$letters = $letters_separator.$letters;
			}

			if($i_one == 0){
				$letters = $ten[$i_ten];
			}
			elseif($i_ten == 1 && $i_one > 0){
				$letters = $exceptions[$i_one];
			}
			else{
				$letters = $ten[$i_ten].$letters;
			}

			$isset_ten = true;
		}

		// hundred
		if(($i-2 >= 0) && $i_hundred > 0 && isset($hundred[$i_hundred])){
			if($isset_ten || $isset_one){
				$letters = $letters_separator.$letters;
			}

			$letters = $hundred[$i_hundred].$letters;
			$isset_hundred = true;
		}

		if($i_one < 1 && $i_ten < 1 && $i_hundred < 1){
			$letters = '';
		}
		else{
			$letters .= ' '.$categories[($money_len-$i-1)/3];
		}

		if(!empty($letters) && $i >= 3){
			$letters = $letters_separator.$letters;
		}

		$persian_letters = $letters.$persian_letters;
	}

	return $persian_letters;
}


function MoneyToLetters($params, $smarty)
{
	$Num = $params['num'];
		// طبقه بندی بیشتر را به ابتدای لیست اضافه کنید
	$categories = array(
		'سکستیلیون',
		'کوانتینیارد',
		'کوانتینیوم',
		'کادریلیارد',
		'کادریلیون',
		'تریلیارد',
		'تریلیون',
		'بیلیارد',
		'بیلیون',
		'میلیارد',
		'میلیون',
		'هزار',
		'',
	);

	$Num3="";
	$Num2=explode(',',number_format($Num));
	for($i=0;$i<count($Num2);$i++)
	{
		if($Num2[$i] !=0 )
		{
			$params['number'] = $Num2[$i] ;
			$Num3.=digit_to_persain_letters($params);
			$Num3.=" ".$categories[count($categories)-count($Num2)+$i]." ";
		}
		if((($i<count($Num2)-1) && ($Num2[$i+1]) != "000")) $Num3.=" و ";

	}



	return $Num3;
}


function jdateConvertSmarty($params, $smarty)
{
	require_once(__DIR__.'/../jdf/jdf.php');
	if ( !isset($params['persian']) )
		$params['persian'] = 'fa';
	return jdate( $params['format'] ,$params['time'] , '', 'Asia/Tehran', $params['persian'] );
}


function jdateAgoConvertSmarty($params, $smarty)
{
	require_once(__DIR__.'/../jdf/jdf.php');
	$time = time()-$params['time'] ;
	if ( $time < 0 )
		return '── پایان یافته ──';
	if ( $time < 60 )
		return $time .' ثانیه پیش';
	if ( $time < 3600 )
		return ( ceil($time / 60) ) .' دقیقه پیش';
	if ( $time < 86400 )
		return ( round($time / 3600) ) .' ساعت پیش';
	if ( $time < 172800 )
		return 'دیروز';
	if ( $time < 2592000 )
		return ( round($time / 86400) ) .' روز پیش';
	if ( $time < 31536000 )
		return jdate( 'j F' ,$params['time'] , '', 'Asia/Tehran', 'en' );

	return jdate( 'Y' ,$params['time'] , '', 'Asia/Tehran', 'en' );
}


function jdateThenConvertSmarty($params, $smarty)
{
	require_once(__DIR__.'/../jdf/jdf.php');
	$time = $params['time'] - time() ;
	if ( $time < 0 )
		return '';
	if ( $time < 60 )
		return $time .' ثانیه دیگر';
	if ( $time < 3600 )
		return ( ceil($time / 60) ) .' دقیقه دیگر';
	if ( $time < 86400 )
		return ( round($time / 3600) ) .' ساعت دیگر';
	if ( $time < 172800 )
		return 'فردا';
	if ( $time < 2592000 )
		return ( round($time / 172800) ) .' روز دیگر';
	if ( $time < 31536000 )
		return ( round($time / 2592000) ) .' ماه دیگر';

	return 'سال '.jdate( 'Y' ,$params['time'] , '', 'Asia/Tehran', 'en' );
}

function jdateThenAgoConvertSmarty($params, $smarty)
{
	if ( $params['time'] > time() )
		return jdateThenConvertSmarty($params,$smarty);
	return jdateAgoConvertSmarty($params,$smarty);
}

function formating($params, $smarty)
{
	$defultStr = $params['string'] ;
	$params['string'] = chunk_split(  $params['string'], $params['number'] , $params['explode'] ) ;
	if ( $params['lastundow'] && strlen($defultStr) % $params['number'] == 0 )
		$params['string'] = substr(  $params['string'], 0 , strlen($params['string']) - strlen($params['explode']) ) ;
	if ( $params['persian'] ){
		$num_a=array('0','1','2','3','4','5','6','7','8','9');
		$key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
		$params['string']  = str_replace($num_a,$key_a,$params['string']);
	}
	return  $params['string']  ;
}
function formatingNumbers($params, $smarty)
{
	$num_a=array('0','1','2','3','4','5','6','7','8','9');
	$key_a=array('۰','۱','۲','۳','۴','۵','۶','۷','۸','۹');
	$params['string']  = str_replace($num_a,$key_a,$params['string']);
	return  $params['string']  ;
}
